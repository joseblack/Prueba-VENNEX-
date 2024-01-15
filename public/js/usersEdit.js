const links = document.getElementsByClassName("linkUsers");

for (const element of links) {
    let link = element;
    link.addEventListener("click", function(event) { 
        event.preventDefault();
        let href = link.href;
        if (href) {
            showFormToEdit(href);
        }
    });
}

/**
 * Show the form for update the specified resource
 * @param {*} href 
 */
function showFormToEdit(href) {
 
    fetch(href)
        .then((response) => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error("La petición falló: " + response.status);
            }
        })
        .then((result) => {
            let bodyres = document.getElementById("bodyRestEdit");
            bodyres.innerHTML = result;
            bodyres.style.display = "block";
            const btnDelete = document.getElementById("btn-edit-close");
            // btnDelete.addEventListener("click", vaciarModal);
        })
        .catch(function (error) {
            console.log("Page " + href + " cannot open. Error:" + error);
        });
}



