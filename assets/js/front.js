var $ = require('jquery');

$(function() {
  
    const getUploadFiles = {
        container: '#bus_station_save',
        selector: '.custom-file-input',
        header: 'Uploaded files',
        form: '#bus_station',
        max_files: 3,
        handleFileList: function() {
            let file_list = this.files;
            let file_length = file_list.length;
            let content = '';
            $('.file-container').remove();
            if ( file_length <= 3) {
                for (let i = 0; i < file_length; i++) {
                let{name, size, type} =  file_list[i];
                content += `<div class="col-sm-4 d-flex flex-column">
                <div>name: ${name}</div><div>size: ${size}</div> type: ${type}<div></div>
                </div>`
                }
               
                const new_element = document.createElement('div');
                    new_element.className = 'file-container form-group bg-info rounded p-3 text-white';
                    new_element.innerHTML = `<div class="row"><div class="col-sm-12 text-center mb-3"><h2>${getUploadFiles.header}</h2></div>${content}</div>`;

                const container_file = document.querySelector(getUploadFiles.container).parentNode;
                document.querySelector(getUploadFiles.form).insertBefore(new_element, container_file);
                $(getUploadFiles.selector).siblings(".custom-file-label").addClass("selected").html(`Number files: ${file_length}`);

            } else {
                $(getUploadFiles.selector).siblings(".custom-file-label").
                addClass("selected").html(`<span class="text-danger">Maximum download files equal ${getUploadFiles.max_files}</span> `);
            }        
        },

        init: function() {          
            const input_element = document.querySelector(this.selector);
            input_element.addEventListener("change", this.handleFileList);
        }
    };

    getUploadFiles.init();

});