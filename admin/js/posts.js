const plusSpan = document.querySelector('#plusSpan')
const addPostBtn = document.querySelector('#addPostBtn');
const CKeditor = document.querySelector('#body');
const selectAllBoxes = document.querySelector('#selectAllBoxes');
const selectAllCheckboxes = document.querySelectorAll('.checkBoxes');

let num = 1;

$(document).ready(function() {
    if(CKeditor){
    
        cKedit();
    }
    if(selectAllBoxes){
        selectAllBoxes.addEventListener('click', function (e) {
            if(selectAllBoxes.checked) {
                for(let checkbox of selectAllCheckboxes){
                    checkbox.checked = true;
                }
            } else {
                for(let checkbox of selectAllCheckboxes){
                    checkbox.checked = false;
                }
            }
        })

    }

    if(addPostBtn){
        addPostBtn.addEventListener('mouseenter', function(event){
             plusSpan.style.color = 'red';
        
        })
        
        addPostBtn.addEventListener('mouseleave', function(event){
            plusSpan.style.color = 'white';
        })
    
    }
    
    function cKedit() {
        ClassicEditor
            .create(CKeditor)
            .catch(error => {
                console.error(error);
            });
    }

})
