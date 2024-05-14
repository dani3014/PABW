<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Kelas Zoom</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Kelas Zoom</h2>
    <table id="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Kelas</th>
                <th>Deskripsi</th>
                <th>ID Instruktur</th>
                <th>Waktu Mulai</th>
                <th>Waktu Berakhir</th>
                <th>Link Zoom</th>
                <th>Waktu Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class_id="tableBody"></tbody>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'getkelas.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var table = $('#data-table tbody');
                    $.each(data, function (index, item) {
                        table.append('<tr><td>' + item.class_id + '</td><td>' + item.class_name + '</td><td>' + item.description + '</td><td>' + item.instructor_id + '</td><td>' + item.start_time + '</td><td>' + item.end_time + '</td><td>' + item.zoom_link + '</td><td>' + item.created_at + '</td><td> <button class="hapus-btn" data-class_id="' + item.class_id + '">Hapus</button></td></tr>');
                    });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });

            $('#data-table').on('click', '.hapus-btn', function () {
                var class_id = $(this).data('class_id');
                var row = $(this).closest('tr');
                $.ajax({
                    url: 'deletekelaszoom.php',
                    type: 'POST',
                    data: { class_id : class_id },
                    success: function (response) {
                        row.remove();
                        console.log('Data berhasil dihapus');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
