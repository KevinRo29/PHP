function confirmDelete(event, productCode) {
    event.preventDefault();

    Swal.fire({
        title: 'Confirm deletion',
        text: 'Are you sure you want to delete this product?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `Controller/delete_product.php?code=${productCode}`;
        }
    });
}