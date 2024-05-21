document.addEventListener("DOMContentLoaded", function () {
  /**
   * This script code is for displaying text area for editing comment
   * comments are in array so selected all edit buttons
   */
  let editButtons = document.querySelectorAll("#editCommentButton");

  // loop thrigh all buttons
  editButtons.forEach(function (button) {
    // listen for onclick event
    button.addEventListener("click", function () {
      // get attribure - to fetch id of comment
      var commentId = this.getAttribute("data-comment-id");

      // based on above is selecting form and display it
      let commentTextarea = document.querySelector(`#commentForm${commentId}`);

      // display text area
      commentTextarea.style.display = "block";
    });
  });

  /**
   * this function is to display message on screen
   * @param {*} message
   * @param {*} type
   */
  function showError(message, type) {
    // select alert message
    let alertMessage = document.querySelector("#alertMessage");
    // set message
    alertMessage.textContent = message;
    // set class according to message type
    if (type === "error") {
      alertMessage.className = "alert alert-danger";
    } else {
      alertMessage.className = "alert alert-success";
    }
    alertMessage.style.display = "block";

    // hide div after 5 seconds
    setTimeout(function () {
      alertMessage.style.display = "none";
    }, 5000);
  }

  // from url check if error or success parameter found
  const params = new URLSearchParams(window.location.search);
  const error = params.get("error");
  const success = params.get("success");
  if (error) {
    // function call to show message
    showError(error, "error");
  }
  if (success) {
    // function call to show message
    showError(success, "success");
  }
});
