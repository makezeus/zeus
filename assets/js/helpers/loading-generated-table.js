let debounceTimeout;

function debounce(func, delay) {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(func, delay);
}

function handleSubmit(event) {
  realizarBusca(event.target.value);
}

function onInputChange(event) {
  debounce(() => {
    handleSubmit(event);
  }, 800);
}

function realizarBusca(value) {
  console.log(value)
  $("#loading-indicator").removeClass("hidden");
  $("#generated_table").addClass("hidden");

  $.ajax({
    url: `${window.location.pathname}/gerenciar/`,
    method: "POST",
    data: {
      termo: value,
    },
    success: function (data) {
      $("#table-container").html(data);
      $("#loading-indicator").addClass("hidden");
      $("#generated_table").removeClass("hidden");
    },
    error: function (error) {
      console.error("Erro na requisição:", error);
      $("#loading-indicator").addClass("hidden");
    },
  });
}
