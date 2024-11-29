

new_btn.addEventListener("click", async function(){
    
    
    if (item_form.className == "item_form_show") {
        item_form.className = "item_form"
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        await sleep(100);
        item_form.className = "item_form_show"}
    else { 
        item_form.className = "item_form_show" 
    }
    
})

cancel_btn.addEventListener("click", function(){
    
    
    if (item_form.className == "item_form_show") {item_form.className = "item_form"}
    
})

edit_cancel_btn.addEventListener("click", function(){
    
    
    if (edit_form.className == "item_form_show") {edit_form.className = "item_form"}
    
})

items = document.getElementsByClassName("item");
Array.from(items).forEach(element => {
    let button = element.querySelector("#buttons");
    element.addEventListener("mouseenter", function () {
        button.style.display = 'block';
        button.style.filter = "blur(0px)";
    });

    element.addEventListener("mouseleave", function () {
        button.style.display = 'none';
    });
});


edit_btn = document.getElementsByClassName("edit_btn");
Array.from(edit_btn).forEach(element => {
    element.addEventListener("click", () => {
        const parentDiv = element.parentElement;
        const item_cont = parentDiv.parentElement;
        let item_content = item_cont.querySelector(".item_content");
        
        let parts = item_content.children[0].src.split("/");
        let item_price = item_content.children[5].querySelector("span").innerHTML.split("PHP");

        document.getElementById('edit_image').value = parts[1];
        document.getElementById('edit_id').value = item_content.children[2].querySelector("span").innerHTML;
        document.getElementById('edit_name').value = item_content.querySelector("span").innerHTML;
        document.getElementById('edit_type').value = item_content.children[3].querySelector("span").innerHTML;
        document.getElementById('edit_stock').value = item_content.children[4].querySelector("span").innerHTML;
        document.getElementById('edit_price').value = item_price[0];

        if (item_form.className == "item_form_show") {item_form.className = "item_form"}

        edit_form.className = "item_form_show"

        
    })
})


item_content = document.getElementsByClassName("item_content");
Array.from(item_content).forEach(element => {
    const image = element.querySelector('img');
    const imageSrc = image.getAttribute('src');
    if (!imageSrc || imageSrc.trim() === '') {
        image.src = "uploads/placeholder.png";
        image.style.opacity = 0;
    }
})



delete_btn = document.getElementsByClassName("delete_btn");
Array.from(delete_btn).forEach(element => {
    element.addEventListener("click", () => {
        
        const parentDiv = element.parentElement;
        const item_cont = parentDiv.parentElement;
        const item_content = item_cont.querySelector(".item_content");
        var itemId = item_content.children[2].querySelector("span").innerHTML;
        document.getElementById('delete_id').value = itemId
        warn.innerHTML = "Are you sure you want to delete this item with ID: <b>[" + itemId + "]? </b>";

        delete_form.className = "show";
    })
})

no_btn.addEventListener("click", () => {
    delete_form.className = "item_form";
})


document.getElementById("upload_image_btn").addEventListener("click", function() {
    document.getElementById("image_input").click();
});

document.getElementById("image_input").addEventListener("change", function(event) {
    var fileName = event.target.files[0]?.name;  
    if (fileName) {
        console.log("Selected file: " + fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector("#pic img").src = e.target.result; 
        };
        reader.readAsDataURL(event.target.files[0]);
    }
});

window.onload = function() {
    fetch('db.php')
        .then(response => response.text())
        .then(data => console.log("create db successful"));


    fetch('read.php')
        .then(response => response.text())
        .then(data => console.log("read successful"));
};


function selectionSort(unsorted) {
    let sorted = [];

    while (unsorted.length != 0) {
        let min = Math.min(...unsorted);
        sorted.push(min);

        let index = unsorted.indexOf(min);
        if (index > -1) {
            unsorted.splice(index, 1);
        }
    }

    return sorted;
}


function sortElements(item, sorted) {
    let es = document.getElementsByClassName("item");
    
    Array.from(es).forEach(elements => {
        
        let value;
        if (item) {
            value = elements.children[0].children[5].querySelector("span").innerHTML.split("PHP")[0];
        } else {
            value = elements.children[0].children[4].querySelector("span").innerHTML;
        }
        
        let index = sorted.indexOf(parseFloat(value));
        
        if (index > -1) {
            elements.style.order = index + 1
        }
        
    })
}

delete_btn = document.getElementsByClassName("sort");
Array.from(delete_btn).forEach(element => {
    element.addEventListener("click", () => {
        let unsortedArr_price = [];
        let unsortedArr_stock = [];
        
        let items = document.getElementsByClassName("item_content");
        Array.from(items).forEach(element => {
            const item_price = element.children[5].querySelector("span").innerHTML.split("PHP");
            const id = element.children[2].querySelector("span").innerHTML;
            unsortedArr_price.push(parseFloat(item_price[0]));
            unsortedArr_stock.push(parseFloat(element.children[4].querySelector("span").innerHTML));
            
        })
        if (element && element.value == "price") {
            sortElements(true, selectionSort(unsortedArr_price));

        }else if (element && element.value == "stock") {
            sortElements(false, selectionSort(unsortedArr_stock));
        }
    })
})


type_select.addEventListener("click", () => {
    let element_type = type_select.value;
    console.log(element_type)
    
    if (element_type == "") {return}
    let items = document.getElementsByClassName("item");
    Array.from(items).forEach(element => {
        const type = element.children[0].children[3].querySelector("span").innerHTML;
        if (!(type == element_type) && element_type != "N/A") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }
    })
    
})


word = ""
inp.addEventListener("keydown", (event) => {
    let key = event.key;
    
    if (key == "Backspace") {
        word = word.slice(0, word.length - 1)
    }
    else if (key == "Enter") {
        word = ""
        inp.value = ""
    }
    else if (key.match(/[a-zA-Z]/)) {
        word += key;
    }
    Array.from(items).forEach(element => {
        let type = element.children[0].querySelector("span").innerHTML;
        if (!(type.toLowerCase().includes(word.toLowerCase())) && word != "") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }
    })
})

inp.addEventListener("blur", async() => {
    word = ""
    inp.value = ""
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    await sleep(100);
    Array.from(items).forEach(element => {
        let type = element.children[0].querySelector("span").innerHTML;
        if (!(type.toLowerCase().includes(word.toLowerCase())) && word != "") {
            element.style.display = "none";
        } else {
            element.style.display = "block";
        }
    })
});
