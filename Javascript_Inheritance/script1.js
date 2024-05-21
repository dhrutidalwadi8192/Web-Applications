let form = document.querySelector("#songForm");
window.addEventListener("DOMContentLoaded", () => {
  // add submit event listener to form
  form.addEventListener("submit", function (e) {
    const number = validateInput();
    // if valid integer then generate song lyrics
    if (number) {
      // function call to generate song lyrics
      const songLyrics = generateSong(number);
      // get lyrics result div to display song lyrics
      const lyricsResult = document.querySelector("#lyricsResult");
      // display song lyrics
      lyricsResult.innerHTML = `<h3> Here is your song lyrics </h3> <br><p>${songLyrics.join(
        "<br></p>"
      )}`;
    }
    e.preventDefault();
  });

  form.addEventListener("reset", function (e) {
    e.preventDefault();
    // clear fields
    clearFields();
  });
});

// function to validate user input
const validateInput = () => {
  const userInput = document.querySelector("#userInput").value;
  if (isNaN(userInput)) {
    // clear fields and show alert message
    clearFields(true);
    showAlert("Please enter a number", "error");
  } else if (userInput > 1000) {
    // clear fields and show alert message
    clearFields(true);
    showAlert("Please enter a number less than 1000", "error");
  } else if (userInput < 1) {
    // clear fields and show alert message
    clearFields(true);
    showAlert("Please enter a number greater than 0", "error");
  } else {
    return userInput;
  }
};

// function to show alert messages
const showAlert = (message, className) => {
  let div = document.createElement("div");
  div.className = className;

  div.innerHTML = `<p>${message}</p>`;
  div.id = "messagebox";
  let container = document.querySelector(".form-div");
  container.insertBefore(div, form);

  setTimeout(function () {
    document.querySelector("#messagebox").remove();
  }, 3000);
};

// function to clear fields
const clearFields = (onlyClearResult) => {
  if (onlyClearResult) {
    document.querySelector("#lyricsResult").innerHTML = "";
  } else {
    document.querySelector("#userInput").value = "";
    document.querySelector("#lyricsResult").innerHTML = "";
    document.querySelector("#messagebox").remove();
  }
};

// function to generate song lyrics
const generateSong = (num) => {
  const lyrics = [];
  // iteretate through the number of bottles and generate lyrics
  for (let i = num; i > 0; i--) {
    if (i > 1) {
      lyrics.push(
        `${i} bottles of milk on the wall, ${i} bottles of milk. <br>Take one down, pass it around, <br>${
          i - 1
        } bottles of milk on the wall.<br>`
      );
      // for the last bottle display the singular form of bottle
    } else {
      lyrics.push(
        `1 bottle of milk on the wall, 1 bottle of milk. <br>Take one down, pass it around, <br>no more bottles of milk on the wall!`
      );
    }
  }
  return lyrics;
};
