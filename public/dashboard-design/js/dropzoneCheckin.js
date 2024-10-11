
    var dropzonePreviewNode = document.querySelector("#dropzone-preview-list-checkin"),
        previewTemplate = (dropzonePreviewNode.itemid = "", dropzonePreviewNode.parentNode.innerHTML),
        dropzone = (dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode), new Dropzone(".dropzone-checkin", {
            url: "https://httpbin.org/post",
            method: "post",
              maxFiles: 1, 
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview-checkin",
            paramName: "checkin",
            success: function(file, response) {
                // Append the hidden input element with the dataURL and name attribute set to 'cover[]'
                $('form').append('<input type="hidden" name="checkin" value="' + file.dataURL  + '">');
                
                // Add a class to the preview element if it exists to indicate success
                if (file.previewElement) {
                    file.previewElement.classList.add("dz-success");
                }
            },
            removedfile: function(file) {
                if (file.previewElement && file.previewElement.parentNode) {
                    file.previewElement.parentNode.removeChild(file.previewElement);
                }
            },
        
            init: function() {
                var myDropzone = this;

                this.on("maxfilesexceeded", function(file) {
                    myDropzone.removeFile(file);
                    alert("You can only upload one file.");
                });

                this.on("addedfile", function(file) {
                    var existingFile =  $('#dropzone-preview-checkin').find('li').length; 
                    if (existingFile > 1) {
                        myDropzone.removeFile(file);
                        alert("A file already exists. Remove the existing file before uploading a new one.");
                    }
                });
            }
        }));
