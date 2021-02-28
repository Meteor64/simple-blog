function destroyItem(event, id) {
    event.preventDefault();
    let form = 'destroy-' + id;
    Swal.fire({
        title: 'آیا مطمئن هستید؟!',
        text: "نمی توانید این اطلاعات را برگردانید!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله ، حذف کن!',
        cancelButtonText: 'بی خیال'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(form).submit();
        }
    })
}
// Select2
$(document).ready(function() {
    $('.custom-select').select2();
});
