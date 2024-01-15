const botones = document.getElementsByClassName("btn-trash");

// const btnCloseGeneral = document.getElementById("btn-close-general");
// btnCloseGeneral.addEventListener("click", vaciarModal);

for (const element of botones) {
  let boton = element;
  boton.addEventListener("click", function(event) { 
      event.preventDefault();
      let href =  boton.getAttribute("data");
      console.log("boton link", href);
      if (href) {
        showFormToDelete(href);
      }
  });
}

/**
 * Show the form for deleting the specified resource
 * @param {*} href 
 */
function showFormToDelete(href) {

  fetch(href)
      .then(function (response) {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error("La petición falló: " + response.status);
        }
      })
      .then(function (result) {
        // Seleccionamos el elemento con el id bodyres
        let bodyres = document.getElementById("bodyres");
        // Le asignamos el resultado como contenido HTML
        bodyres.innerHTML = result;
        bodyres.style.display = "block";
        const btnDelete = document.getElementById("btn-delete");
        btnDelete.addEventListener("click", vaciarModal);
      })
      .catch(function (error) {
        console.log("Page " + href + " cannot open. Error:" + error);
      });
}

/**
 * Delete the form after hide the modal
 */
// function vaciarModal() {
//   console.log("dentra");
//   let bodyres = document.getElementById("bodyres");
//   bodyres.innerHTML = "";
// }

// window.onclick = function(event) { 
//     if (event.target == exampleModal) { 
//         vaciarModal();
//         modal.style.display = "none"; 
//     } 
// }