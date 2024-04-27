const pdtname = document.querySelectorAll(".pdtname");

pdtname.forEach(element => {
    element.addEventListener("click",(e)=>{
        const text = element.innerText;
        const newPrice = element.parentElement.children[1].querySelector(".new-price").innerText;
        const oldPrice = element.parentElement.children[1].querySelector(".old-price").innerText;
        const imgSrc = element.parentElement.parentElement.querySelector(".product-img-wrapper").querySelector("img").src;
        localStorage.setItem("text",text);
        localStorage.setItem("newPrice",newPrice);
        localStorage.setItem("oldPrice",oldPrice);
        localStorage.setItem("imgSrc",imgSrc);
        window.location.href = "./product-details.php";

    });
});
