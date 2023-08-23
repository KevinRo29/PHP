// Función genérica para confirmar eliminación
function confirmDelete(event, message, confirmAction) {
    event.preventDefault();

    Swal.fire({
        title: 'Confirm deletion',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
    }).then((result) => {
        if (result.isConfirmed) {
            confirmAction();
        }
    });
}

// Llamada a la función de confirmación para eliminar una categoría
function deleteCategory(id) {
    window.location.href = `../Controller/Categories/delete_category.php?id=${id}`;
}

// Llamada a la función de confirmación cuando se hace clic en el botón de eliminar categoría
function confirmDeleteCategory(event, id) {
    const message = 'Are you sure you want to delete this category?';
    confirmDelete(event, message, () => deleteCategory(id));
}

// Llamada a la función de confirmación para eliminar un producto
function deleteProduct(productCode) {
    window.location.href = `../Controller/Products/delete_product.php?code=${productCode}`;
}

// Llamada a la función de confirmación cuando se hace clic en el botón de eliminar producto
function confirmDeleteProduct(event, productCode) {
    const message = 'Are you sure you want to delete this product?';
    confirmDelete(event, message, () => deleteProduct(productCode));
}

// Escucha los clics en los botones de eliminar categoría y llama a confirmDeleteCategory
document.addEventListener('DOMContentLoaded', () => {
    const deleteCategoryButtons = document.querySelectorAll('.btn-delete-category');
    
    deleteCategoryButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const categoryId = button.getAttribute('data-category-id');
            confirmDeleteCategory(event, categoryId);
        });
    });

    // Escucha los clics en los botones de eliminar producto y llama a confirmDeleteProduct
    const deleteProductButtons = document.querySelectorAll('.btn-delete-product');
    
    deleteProductButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productCode = button.getAttribute('data-product-code');
            confirmDeleteProduct(event, productCode);
        });
    });
});
