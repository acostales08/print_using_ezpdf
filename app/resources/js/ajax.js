jQuery(document).ready(() => {
    const fetchData = () => {
        $.ajax({
            url: "app/helper/helper.php?isFetch=true",
            type: "GET",
            dataType: "json",
            success: (response) => {
                if (response && response.status === "success" && response.data) {
                    let scode = response.data;
                    jQuery(".form-select").each(function(index, element) {
                        let selectStudentCode = jQuery(element);
                        selectStudentCode.empty();
    
                        let initialOption = jQuery("<option>").val("").text("Select");
                        selectStudentCode.append(initialOption);
    
                        scode.forEach(item => {
                            let option = jQuery("<option>").val(item.studentCode).text(item.studentCode);
                            selectStudentCode.append(option);
                        });
                    });
                } else {
                    console.error("Failed to fetch data");
                }
            },
            error: (xhr, status, error) => {
                console.error("Error fetching data:", xhr.responseText);
            }
        });
    }
    fetchData();

    $('#btnSubmit').on('click', function() {
        var fetcherCode = $('#txtfetcherCode').val();
        var fetcherName = $('#txtfetcherName').val();
        var contactNum = $('#txtContactNum').val();
        var regDate = $('#txtregDate').val();
        var isActive = $('#activeStatus').is(':checked') ? 1 : 0;

        var students = [];
        for (var i = 1; i <= 5; i++) {
            var studentCode = $('#studentCode' + i).val();
            var relation = $('#relation' + i).val();
            if (studentCode && relation) {
                students.push({
                    studentCode: studentCode,
                    relation: relation
                });
            }
        }

        const data = {
            isTrue: true,
            fetcherCode: fetcherCode,
            fetcherName: fetcherName,
            contactNum: contactNum,
            regDate: regDate,
            isActive: isActive,
            students: students
        }
        console.log(data)
        $.ajax({
            url: 'app/helper/helper.php',
            method: 'POST',
            data: data,
            success: ((response) => {
                console.log(response);
                location.reload();
            }),
            error: ((xhr, status, error) =>  {
                alert('An error occurred: ' + error);
            })
        });
    });

    const fetchJoinTable = () => {
        $.ajax({
            url: "app/helper/helper.php?isFetchData=true",
            type: "GET",
            dataType: "json",
            success: ((response) => {
                console.log(response)
            })
        })
    }
    fetchJoinTable()
});
