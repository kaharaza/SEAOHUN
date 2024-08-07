$("#formSubmit").on("submit", function (event) {
  event.preventDefault();

  const fname = $("#fname").val();
  const lname = $("#lname").val();
  const phone = $("#phone").val();
  const email = $("#email").val();

  const payload = {
    fname: fname,
    lname: lname,
    phone: phone,
    email: email,
  }; // object

  console.log(payload); // ทดสอบค่าที่ส่งมาใน object

  // const payload = [] // array

  if (fname && lname && phone && email) {
    try {
      $.ajax({
        url: "./service/create.php",
        method: "POST",
        dataType: "json",
        data: {
          payload: payload,
        },
      })
        .done((res) => {
          if (res.response === "Success") {
            Swal.fire({
              title: "บันทึกข้อมูลสำเร็จ",
              icon: "success",
            }).then(() => {
              window.location.href = ''
            })
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
  } else {
    Swal.fire({
      title: "Error",
      icon: "error",
    });
  }
});
