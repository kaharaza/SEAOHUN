$(document).ready(function () {
  fetchData();
});
const fetchData = async () => {
  try {
    await $.ajax({
      url: "./../service/fetch_data.php",
      method: "GET",
      dataType: "json",
    })
      .done((res) => {
        if (res.response.success === true) {
          const data = res.response.results ? res.response.results : null;
          const count = res.response.count ? res. response.count: null;
          tableData(data, count);
        }
      })
      .fail((e) => {
         Swal.fire({
           title: "Error",
           icon: "error",
           
         });
      });
  } catch (e) {
    Swal.fire({
      title: "Error",
      icon: "error",
      text: e,
    });
  }
};

const tableData = (data, count) => {
  try {
    // console.log(data); // check ค่าที่ส่งมา ใน console
    let html = "";
    html += `
    <h1>จำนวนชื่อทั้งหมด ${count} ท่าน </h1> 
              <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ชื่อ</th>
                                        <th>นามสกุล</th>
                                        <th>เบอร์โทร</th>
                                        <th>อีเมล</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
            ${
              data.length > 0
                ? data
                    .map(
                      (item, index) => `
                              <tr>
                                <td>${index + 1}</td>
                                <td>${item.fname}</td>
                                <td>${item.lname}</td>
                                <td>${item.phone}</td>
                                <td>${item.email}</td>
                                <td>
                                  <button onclick="showEdit(${item.id}, '${item.fname}', '${item.lname}' , '${item.phone}')" class="btn btn-warning">
                                      แก้ไข
                                  </button>
                                  <button onclick="habdleDelete(${
                                    item.id
                                  })" class="btn btn-danger">
                                   ลบ
                                  </button>
                                </td>
                              </tr>
              `
                    )
                    .join("")
                : null
            }                       
                              </tbody>
            </table>    
    `;
    $("#table_fetchData").html(html);
  } catch (e) {
    Swal.fire({
      title: "Error",
      icon: "error",
      text: e,
    });
  }
};

const habdleDelete = async (id) => {
  try {
    
    const button = await Swal.fire({
      title: "ยืนยันการลบข้อมูลนี้ใช่หรือไม่",
      icon: "question",
      showConfrimButton: true,
      showCancelButton: true
    });

    if (button.isConfirmed) {
      await $.ajax({
        url: './../service/delete.php',
        method: "DELETE",
        dataType: 'json',
        data: {
          id:id
        }
      }).done(async(res) => {
         const result = await res
         if (result.status === true) {
           Swal.fire({
             icon: "success",
             title: "ลบข้อมูลสำเร็จ",
           });
           fetchData();
         }
      }).fail((e) => {
        Swal.fire({
          title: "Error",
          icon: "error",
          text: e,
        });
      })
    }
  } catch (e) {
   Swal.fire({
     title: "Error",
     icon: "error",
     text: e,
   });
  }
}


const showEdit = (id,fname,lname, phone) => {
 try {
     let html = `
            <div class="modal fade" id="dynamicModal" tabindex="-1" aria-labelledby="dynamicModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="dynamicModalLabel">แก้ไขข้อมูล</h1>
                            <button type="button" class="btn-close" id="CloseModal" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                             
                            <div class="row g-2">
                                <input type="text" value="${id}" class="form-control" id="id"  hidden>
                                <div class="col-lg-6 col-12">
                                    <label for="fname">ชื่อ</label>
                                    <input type="text" value="${fname}" class="form-control" id="fname">
                                </div>
                                <div class="col-lg-6 col-12">
                                    <label for="lname">นามสกุล</label>
                                    <input type="text" value="${lname}" class="form-control" id="lname">
                                </div>
                                <div class=" col-12">
                                    <label for="phone">เบอร์โทร</label>
                                    <input type="text" value="${phone}" class="form-control" id="phone">
                                </div>
                                
                                <button type="buttom" onclick="formSubmit()" class="btn btn-primary">บันทึกข้อมูล</button>
                            </div>
                        
                        </div>
                       
                    </div>
                </div>
            </div>
        `;

     // Append the modal HTML to the DOM
     document.body.insertAdjacentHTML("beforeend", html);

     // Show the modal
     const modal = new bootstrap.Modal(document.getElementById("dynamicModal"));
     modal.show();

     // Remove the modal from the DOM after it is hidden
     $("#dynamicModal").on("hidden.bs.modal", function () {
       document.getElementById("dynamicModal").remove();
     });
  
 } catch (e) {
  Swal.fire({
    title: "Error",
    icon: "error",
    text: e,
  });
 }
}

const formSubmit = async () => {
  try {
    const id = $("#id").val();
    const fname = $("#fname").val();
    const lname = $("#lname").val();
    const phone = $("#phone").val();

    const payload = {
      id: id,
      fname: fname,
      lname: lname,
      phone: phone,
    };

    if (id && fname && lname && phone) {
      await $.ajax({
        url: './../service/update.php',
        method: 'POST',
        dataType: 'json',
        data: {
          payload: payload
        } 
      }).done(async(res) => {
        const result = await res;
        console.log(result);
        if (result.status === true) {
          document.getElementById("CloseModal").click();
          fetchData();
        }
      })
    } else {
      Swal.fire({
        icon: 'error',
        title: id == '' ? 'กรอกไอดี': fname == '' ? 'กรอกชื่อ' : lname == '' ? 'กรอกนามสกุล' : phone == '' ? 'กรอกเบอร์โทร': '',
      })
    }
  } catch (e) {
    Swal.fire({
      title: "Error",
      icon: "error",
      text: e,
    });
  }
}