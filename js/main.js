/*===== FOCUS =====*/
const inputs = document.querySelectorAll(".form__input")

/*=== Add focus ===*/
function addfocus(){
    let parent = this.parentNode.parentNode
    parent.classList.add("focus")
}

/*=== Remove focus ===*/
function remfocus(){
    let parent = this.parentNode.parentNode
    if(this.value == ""){
        parent.classList.remove("focus")
    }
}

/*=== To call function===*/
inputs.forEach(input=>{
    input.addEventListener("focus",addfocus)
    input.addEventListener("blur",remfocus)
})

document.addEventListener('DOMContentLoaded', function() {
    const floatingElements = document.querySelectorAll('.floating');

    floatingElements.forEach(element => {
        element.addEventListener('mouseover', () => {
            element.classList.add('animate-pulse');
        });

        element.addEventListener('mouseout', () => {
            element.classList.remove('animate-pulse');
        });
    });
});