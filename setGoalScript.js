const des = document.getElementById("des")
const exe = document.getElementById("exercise")
exe.addEventListener('mouseover', function(){
    des.style.display = "block"
})
exe.addEventListener('mouseout', function(){
    des.style.display = "none"
})