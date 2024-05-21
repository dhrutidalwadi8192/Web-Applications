let form = document.querySelector("#animalForm");

window.addEventListener("DOMContentLoaded", () => {
  form.addEventListener("submit", function (event) {
    event.preventDefault();
    // take user inputs
    let name = document.querySelector("#animalName").value;
    let species = document.querySelector("#animalSpecies").value;
    let phrase = document.querySelector("#animalPhrase").value;

    // create an animal object
    let animal = new Animal(name, species, phrase);

    // display sound and message based on clicked button
    if (event.submitter.id === "getSoundBtn") {
      // get sound result div to display sound
      const result = document.querySelector("#animalSound");
      // funciton call to display sound and bid to result div
      result.innerHTML = `<h3> <strong>Sound : </strong>${animal.sound()} </h3>`;
    } else if (event.submitter.id === "getMessageBtn") {
      let message = document.querySelector("#message").value;
      // check if message is empty
      if (!message) {
        showAlert("Please enter a message", "error");
      } else {
        // get message result div to display message
        const result = document.querySelector("#animalMessage");
        // funciton call to display message and bid to result div
        result.innerHTML = `<h3> <strong>Message : </strong>${animal.say(
          message
        )}<h3>`;
      }
    }
  });

  // rest event hadnlr to clear all fields
  form.addEventListener("reset", function (event) {
    document.querySelector("#animalMessage").innerHTML = "";
    document.querySelector("#animalSound").innerHTML = "";
    document.querySelector("#messagebox").remove();
  });
});

// Animal constructor & prototype
function Animal(name, species, phrase) {
  this.name = name;
  this.species = species;
  this.phrase = phrase;
}

// add sound method to animal prototype
Animal.prototype.sound = function () {
  return `${this.name} the ${this.species} says: ${this.phrase}`;
};

// add say method to animal prototype
Animal.prototype.say = function (message) {
  return `${this.name} the ${this.species} says: ${message}`;
};

// show alert methof to display error messages
const showAlert = (message, className) => {
  let div = document.createElement("div");
  div.className = className;

  div.innerHTML = `<p>${message}</p>`;
  div.id = "messagebox";
  let container = document.querySelector(".form-div");
  container.insertBefore(div, form);

  // set timeout to remove the message after 3 seconds
  setTimeout(function () {
    document.querySelector("#messagebox").remove();
  }, 3000);
};
