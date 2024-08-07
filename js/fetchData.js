
  $(document).ready(function () {
    fetchData();
  });
  const fetchData = async () => {
    try {
      await $.ajax({
        url: "./service/fetchdata.php",
        method: "GET",
        dataType: "json",
      })
        .done((res) => {
          if (res.message === 200) {
            const data = res.response;
            tableData(data);
          }
        })
        .fail((e) => {
          throw e;
        });
    } catch (e) {
      Swal.fire({
        title: "Error",
        icon: "error",
        text: e,
      });
    }
  };

const tableData = (data) => {
  try {
    console.log(data);
  } catch (e) {
    Swal.fire({
      title: "Error",
      icon: "error",
      text: e,
    });
  }
};
