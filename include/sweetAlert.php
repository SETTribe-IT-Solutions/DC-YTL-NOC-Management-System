<?php
session_start();
function setSession($status, $msg)
{
    $_SESSION['status'] = $status;
    $_SESSION['msg'] = $msg;
}
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
</script>
<?php
function toastMsg($status, $msg)
{
    ?>
    <script>
        Toast.fire({
            icon: '<?php echo $status ?>',
            text: '<?php echo $msg ?>'
        })
    </script>
    <?php
}

function sweetMsg($status, $msg)
{
    ?>
    <script>
        Swal.fire({
            title: '<?php echo $msg ?>',
            icon: '<?php echo $status ?>',
            confirmButtonColor: '#3085d6'
        });
    </script>
    <?php
}
?>
<script>

    let toast = (msg, icon) => {
        Toast.fire({
            icon: icon,
            text: msg
        })
    }
    let deletefun = (location, id) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = location + "?delete=" + id;
            }
        })
    }

    let logoutfun = (location) => {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Log Out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log Out!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = location;
            }
        })
    }
</script>