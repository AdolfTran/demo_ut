$(function () {
    $(".updateBtn").click(function () {
        var userId = $(this).attr("data-id");
        $("#updateId").val(userId);
        $("#updateForm").submit();
    });

    // JavaScript で表示
    $('#deleteBtn').on('click', function () {
        $('#deleteModal').modal();
    });
    // ダイアログ表示前にJavaScriptで操作する
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var deleteId = button.data('targetid');
        var deleteName = button.data('targetname');

        $("#deleteId").val(deleteId);

        var modal = $(this);
        modal.find('.modal-body .message').text(deleteName + " のユーザーを削除してよろしいですか？");

    });
    $('#deleteModal').on('click', '.modal-footer .btn-primary', function () {
        $('#deleteModal').modal('hide');
        $('#deleteForm').submit();
    });
});

//sort table
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    dir = "asc";
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}