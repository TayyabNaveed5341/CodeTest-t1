const { default: axios } = require('axios');

require('./bootstrap');

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}
function deleteProjectById(url, element){
    $.ajax({
        headers:{"X-XSRF-TOKEN":getCookie('XSRF-TOKEN')},
        method:"delete",
        url:url,
        data:{},
        success:(data, textStatus, jqXHR)=>{
            console.log('155', 'Anything', data, 'String', textStatus, 'jqXHR', jqXHR)
            if(element.classList.contains('active'))$('.task-list-item').remove()
            element.remove()
        }
    })
}

function getSelectedProject(){
    const projectListItem = $('.project-list .project-list-item.active')
    return{
        id: projectListItem.data('projectId'),
        name:projectListItem.find('.project-name').text()
    }
}

Object.assign(window, {
    confirmAndDeleteProject: function(e, urlTemplate){
        const projectId = e.currentTarget.parentElement.dataset.projectId;
        swal(
            'Delete Project?',
            'This will also delete all tasks under. This action is irreversible.',
            'warning', {buttons: true, dangerMode: true}
        ).then(doDelete=>{
            if(doDelete){
                deleteProjectById(
                    urlTemplate.replace('%id%', projectId),
                    e.currentTarget.parentElement
                )
                swal('Success','Project Deleted')
            }
        })
    },
    confirmAndDeleteTask: (urlTemplate, taskId, jListItem)=>{
        swal(
            'Delete Task?',
            'This action is irreversible.',
            'warning', {buttons: true, dangerMode: true}
        ).then(doDelete=>{
            if(doDelete){
                axios.delete(urlTemplate.replace('%id%', taskId)).then(r=>{
                    jListItem.remove()
                    swal('Success','Project Deleted')
                }).catch(ex=>{
                    swal('Error', ex.response.data.message, 'error')
                })
                
            }
        })
    },
    createOrUpdateProject: function (url,projectName, successCallback, jErrorElement){
        axios.put(url,{"name":projectName}).then(r=>{console.log(r)
            successCallback(r, r.data.data.projectName)
        }).catch(e=>{console.log('177', e.response.data)
            jErrorElement.text(e.response.data.message)
        })
    },    
    getTaskListItemsById:function (url, projectId){
        $.ajax({
            method:"get",
            url:url,
            data:{"project-id":projectId},
            success:(data,  textStatus,  jqXHR)=>{
                $('#taskList').html(data.html)
                console.log('155', 'Anything', data, 'String', textStatus, 'jqXHR', jqXHR)
    
            }
        })
    },    
    putTask: function (url,taskName, successCallback, jErrorElement){
        console.log(78,getSelectedProject())
        axios.put(url,{
            "project_id":getSelectedProject().id,
            "name":taskName
        }).then(r=>{console.log(r)
            successCallback(r, r.data.data.taskName)
        }).catch(e=>{console.log('177', e.response.data)
            jErrorElement.text(e.response.data.message)
        })
    },
    updateTaskOrder: (url, order, callback)=>{
        axios.patch(url, {
            id:order
        }).then(r=>{
            callback(r)
        })
    }
})

