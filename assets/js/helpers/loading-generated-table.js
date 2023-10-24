let debounceTimeout;

function debounce(func, delay) {
  clearTimeout(debounceTimeout);
  debounceTimeout = setTimeout(func, delay);
}

function handleSubmit(event) {
  realizarBusca(event.target.value);
}
function _handleSubmit(event) {
  _realizarBusca(event.target.value);
}

function onInputChange(event) {
  debounce(() => {
    handleSubmit(event);
  }, 800);
}
function _onInputChange(event) {
  debounce(() => {
    _handleSubmit(event);
  }, 800);
}

function _realizarBusca(value) {
  var url = new URL(window.location.href);
  url.searchParams.delete("per_page");
  if (value) {
    url.searchParams.set("search", value);
  } else {
    url.searchParams.delete("search");
  }

  window.history.pushState({}, "", url);

  $("#loading-indicator").removeClass("hidden");
  $("#generated_table").addClass("hidden");

  $.ajax({
    url: window.location.href,
    method: "GET",
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
function realizarBusca(value) {
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
