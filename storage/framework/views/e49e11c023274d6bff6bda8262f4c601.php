<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold" style="color:#15401b;">Carrito de compras</h2>
    <div id="carritoProductos" class="mb-4"></div>
    <div class="d-flex gap-3 justify-content-center">
        <button type="button" class="btn btn-success btn-lg px-4 shadow-sm" id="btnPagar" style="font-weight:600; border-radius: 1.5rem;" data-bs-toggle="modal" data-bs-target="#modalPago">
            <i class="bi bi-credit-card"></i> Ir a pagar
        </button>
        <button onclick="vaciarCarrito()" class="btn btn-outline-dark btn-lg px-4 shadow-sm" style="font-weight:600; border-radius: 1.5rem;">
            <i class="bi bi-trash3"></i> Vaciar carrito
        </button>
    </div>
</div>

<!-- Modal de Pago -->
<div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header" style="background:#f8f9fa;">
        <h5 class="modal-title fw-bold" id="modalPagoLabel" style="color:#15401b;">Finalizar compra</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formPago">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Método de pago</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metodo_pago" id="efectivo" value="Efectivo" required>
              <label class="form-check-label" for="efectivo">
                Efectivo (al recoger)
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="metodo_pago" id="qr" value="QR" required>
              <label class="form-check-label" for="qr">
                QR (escanea para pagar)
              </label>
            </div>
            <div id="qrPagoDiv" class="text-center mb-2" style="display:none;">
              <img src="/imagenes/qr.jpg" alt="QR de cuenta de ahorros" style="max-width:180px; width:100%; border-radius:1rem; border:2px solid #e9ecef; background:#fff; padding:8px;">
              <div style="font-size:0.95rem; color:#15401b; margin-top:0.5rem;">Escanea este QR para pagar a la cuenta de ahorros y enviar a  <a href="https://api.whatsapp.com/send?phone=573246283231&text=Hola%20%F0%9F%91%8B%20Miguelucho" target="_blank"><i class="fab fa-whatsapp"></i>3246283231 </a></div>
              <div style="font-size:0.95rem; color:#15401b; margin-top:0.5rem;">Acepto terminos y condiciones</div>
            </div>
          </div>
          <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios (opcional)</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Enviar pedido</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
    .carrito-card {
        background: #fff;
        border-radius: 1.25rem;
        box-shadow: 0 2px 16px 0 rgba(0,0,0,0.07);
        padding: 1.5rem 1.2rem;
        margin-bottom: 1.2rem;
        transition: box-shadow .2s;
    }
    .carrito-card:hover {
        box-shadow: 0 4px 24px 0 rgba(21,64,27,0.13);
    }
    .carrito-img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 1rem;
        border: 2px solid #e9ecef;
        background: #f8f9fa;
    }
    .carrito-nombre {
        font-size: 1.13rem;
        font-weight: 600;
        color: #15401b;
    }
    .carrito-precio {
        font-size: 1rem;
        color: #198754;
        font-weight: 500;
    }
    .carrito-subtotal {
        font-size: 1.1rem;
        font-weight: 600;
        color: #15401b;
    }
    .carrito-btn-cantidad {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        font-size: 1.3rem;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .carrito-total-label {
        font-size: 1.3rem;
        font-weight: 600;
        color: #15401b;
    }
    .carrito-total {
        font-size: 2rem;
        font-weight: 700;
        color: #198754;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    function mostrarCarrito() {
        let html = '';
        let total = 0;
        if (carrito.length === 0) {
            html = `
                <div class="text-center py-5">
                    <i class="bi bi-cart-x" style="font-size:3rem; color:#bbb;"></i>
                    <p class="mt-3 mb-0" style="font-size:1.2rem;">El carrito está vacío.</p>
                </div>
            `;
            document.getElementById('btnPagar').classList.add('disabled');
        } else {
            document.getElementById('btnPagar').classList.remove('disabled');
            html = '';
            carrito.forEach((prod, idx) => {
                let subtotal = prod.precio * prod.cantidad;
                total += subtotal;
                html += `
                <div class="carrito-card d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center flex-grow-1 gap-3">
                        <img src="/storage/${prod.imagen}" class="carrito-img shadow-sm me-2" alt="${prod.nombre}">
                        <div>
                            <div class="carrito-nombre">${prod.nombre}</div>
                            <div class="text-muted" style="font-size:0.97rem;">$${prod.precio.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2})} c/u</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2 mx-3">
                        <button onclick="cambiarCantidad(${idx}, -1)" class="btn btn-outline-secondary btn-sm carrito-btn-cantidad">−</button>
                        <span style="min-width:32px; text-align:center; font-size:1.1rem;">${prod.cantidad}</span>
                        <button onclick="cambiarCantidad(${idx}, 1)" class="btn btn-outline-secondary btn-sm carrito-btn-cantidad">+</button>
                    </div>
                    <div class="text-end ms-3" style="width:100px;">
                        <span class="carrito-subtotal">$${subtotal.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
                    </div>
                    <button onclick="eliminarProducto(${idx})" class="btn btn-danger btn-sm ms-3" title="Eliminar" style="border-radius:50%;">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>`;
            });
            html += `
                <div class="d-flex justify-content-end align-items-center mt-4">
                    <span class="carrito-total-label me-3">Total:</span>
                    <span class="carrito-total">
                        $${total.toLocaleString('es-MX', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                    </span>
                </div>
            `;
        }
        document.getElementById('carritoProductos').innerHTML = html;
    }

    function cambiarCantidad(idx, cambio) {
        if (carrito[idx]) {
            carrito[idx].cantidad += cambio;
            if (carrito[idx].cantidad < 1) {
                carrito[idx].cantidad = 1;
            }
            localStorage.setItem('carrito', JSON.stringify(carrito));
            mostrarCarrito();
            if (window.actualizarContadorCarrito) window.actualizarContadorCarrito();
        }
    }

    function eliminarProducto(idx) {
        carrito.splice(idx, 1);
        localStorage.setItem('carrito', JSON.stringify(carrito));
        mostrarCarrito();
        if (window.actualizarContadorCarrito) window.actualizarContadorCarrito();
        Swal.fire({
            icon: 'info',
            title: 'Producto eliminado',
            text: 'El producto fue eliminado del carrito.',
            timer: 1200,
            showConfirmButton: false
        });
    }

    function vaciarCarrito() {
        carrito = [];
        localStorage.setItem('carrito', JSON.stringify(carrito));
        mostrarCarrito();
        if (window.actualizarContadorCarrito) window.actualizarContadorCarrito();
    }

    // Manejo del formulario de pago
    document.addEventListener('DOMContentLoaded', function() {
        mostrarCarrito();

        // Mostrar/ocultar QR según selección
        document.querySelectorAll('input[name="metodo_pago"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('qrPagoDiv').style.display = (this.value === 'QR') ? 'block' : 'none';
            });
        });

        document.getElementById('formPago').addEventListener('submit', function(e) {
            e.preventDefault();

            const data = {
                nombre: document.getElementById('nombre').value,
                telefono: document.getElementById('telefono').value,
                metodo_pago: document.querySelector('input[name="metodo_pago"]:checked').value,
                comentarios: document.getElementById('comentarios').value,
                productos: carrito
            };

            fetch('/pedidos', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(res => {
                Swal.fire({
                    icon: 'success',
                    title: '¡Pedido recibido!',
                    text: 'Tu pedido ha sido registrado correctamente.',
                    confirmButtonText: 'Aceptar',
                    customClass: { confirmButton: 'btn btn-success' },
                    buttonsStyling: false
                }).then(() => {
                    window.location.href = '/';
                });
                var modal = bootstrap.Modal.getInstance(document.getElementById('modalPago'));
                modal.hide();
                vaciarCarrito();
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Yeison\Desktop\DulceContigo-final\resources\views/carrito/index.blade.php ENDPATH**/ ?>