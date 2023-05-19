import Swal from 'sweetalert2';

export function showToast(icon, title) {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
    willClose: (toast) => {
      toast.removeEventListener('mouseenter', Swal.stopTimer);
      toast.removeEventListener('mouseleave', Swal.resumeTimer);
      toast.remove();
    },
  });

  Toast.fire({
    icon: icon,
    title: title
  });
}