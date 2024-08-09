$("#CheckIn").submit(async function (event) {
    event.preventDefault();
    try {
        const fname = $("#fname").val();
        const lname = $("#lname").val();

        if(fname && lname) {
           const payload = {
            fname: fname,
            lname: lname
           }
        //    console.log(payload); // Debug ดูค่าที่ส่งมา
           await $.ajax({
            url: './../service/checkin.php',
            method: "POST",
            dataType: 'json',
            data: {
                payload: payload
            }
           }).done(async(res) => {
            const result = await res;
            if (result.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Check in success',
                    html: `
                        <div class="h1">รหัสประจำตัว</div>
                        <div class="h1">${result.response}</div>
                    `
                })
                fetchData(); // เพิ่ม Code fetchData
            }
           }).fail(e => {
            console.log(e.statusText);
               Swal.fire({
                 title: "Error",
                 text: `${e.statusText}`,
                 icon: "error",
               });
           })
        } else {
              Swal.fire({
                title: "Error",
                text: fname == '' ? 'กรอกชื่อ': lname == '' ? 'กรอกนามสกุล' : '',
                icon: "error",
              });
             
        }
    } catch (e) {
        Swal.fire({
          title: "Error",
          text: `${e.statusText}`,
          icon: "error",
        });
    }
})

const fetchData = async () => {
    try {

        await $.ajax({
            url: './../service/fetch_data_checkin.php',
            method: "GET",
            dataType: 'json',
        }).done(async(res) => {
            const results = await res;
            if(results.status === true) {
                const row = results.response;
                tableData(row)
            }
        })
        
    } catch (e) {
         Swal.fire({
           title: "Error",
           text: `${e.statusText}`,
           icon: "error",
         });
    }
}


const tableData = (row) => {
    try {
        let html = '';
        html += `
            <table class="table">
                <thend>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>E-sigin</th>
                    </tr>
                </thend>
                <tbody>
                    ${row.length > 0 ? row.map((item ,index) => `
                            
                        
                    `): null}
                </tbody>
            </table>
        `;
        $("#tableCheckIn").html(html);
    } catch (e) {
        Swal.fire({
          title: "Error",
          text: `${e.statusText}`,
          icon: "error",
        });
    }
}