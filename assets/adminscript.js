

$(document).ready(function () {

    $('#search').keyup(function (e) {
        e.preventDefault();
        var query = $(this).val();
        searchTable(query);
    });

    const searchTable = function (query) {
        return $.ajax({
            type: "GET",
            url: "search.php",
            data: {query},
            dataType: 'json',
            crossDomain: true,
            cache: false,
            async: false,
            success: buildResult
        });
    }

    const loadData = function () {
        return $.ajax({
            type: "GET",
            url: "search.php",
            dataType: 'json',
            crossDomain: true,
            cache: false,
            async: false,
            success: buildResult
        });

    }

    const buildResult = function (response) {
        $('#admin-table-body').empty();
        let result = "";
        if (response.length === 0) {
            result += ` <tr>
                                                    <td colspan="3">No Record Found</td>
                                                </tr>
                                                `
        }
        else {
            $.each(response, function (index, data) {
                result += ` <tr>
                                <td>${data.rname}</td>
                                <td>${data.category}</td>
                                <td>${data.location}</td>
                                <td>
                                    <a href="readstory.php?sid=${data.sid}" class="btn btn-success"  role="button" name="readBTN">Read</a>
                                    <a href="storyedit.php?sid=${data.sid}" class="btn btn-warning"  role="button" name="updateeBTN">Update</a>
                                    <a href="delete.php?sid=<${data.sid}" class="btn btn-danger"  role="button" name="deleteBTN">Delete</a>
                                </td>
                                </td>
                            </tr>
                    
                                                            `
            })
        }

        $('#admin-table-body').append(result)
    }

    loadData()
});