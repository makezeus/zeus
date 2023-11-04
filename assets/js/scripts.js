function handleView(event) {
  let input = $("#password");
  if (event.target.className === "ri-eye-line") {
    event.target.className = "ri-eye-off-line";
    input[0].type = "text";
  } else {
    event.target.className = "ri-eye-line";
    input[0].type = "password";
  }
}

function handleButtonBlock(buttons, disabled, textContent) {
  buttons.forEach((button) => {
    button.disabled = disabled;
    button.textContent = textContent;
  });
}
