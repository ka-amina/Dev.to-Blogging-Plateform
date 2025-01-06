const Tagtable= document.getElementById("tagTable");
const tagForm = document.getElementById("tagForm");
const showTagForm= document.getElementById("showTagForm");

showTagForm.addEventListener("click",(e)=>{
    e.preventDefault();
    // console.log("clicked")
    Tagtable.classList.add("hidden");
    tagForm.classList.remove("hidden")
})
