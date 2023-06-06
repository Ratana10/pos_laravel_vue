import Swal from "sweetalert2";

export default function useNotifications() {

  const confirmNotification = async (name = null) => {
    return new Promise((resolve) => {
      Swal.fire({
        title: `Are you sure delete \n'${name}' ?`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Deleted!",
            text: `${name} has been deleted.`,
            icon: "success",
            timer: 1500,
          }).then(() => {
            resolve(true); // User confirmed the notification
          });
        } else {
          resolve(false); // User canceled the notification
        }
      });
    });
  };


  const showToast = (icon, title) => {
    Swal.fire({
      icon: icon,
      title: title,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      toast: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
      willClose: (toast) => {
        toast.removeEventListener("mouseenter", Swal.stopTimer);
        toast.removeEventListener("mouseleave", Swal.resumeTimer);
        toast.remove();
      },
    });
  };

  return {
    confirmNotification,
    showToast,
  };
}
