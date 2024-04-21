<div class="container">
  <div class="row">
    <div class="col-12">
      <div id="toast-root">
      </div>
    </div>
  </div>
</div>

<style>
  #toast-root {
    position: fixed;
    right: 20px;
    top: 100px;
  }

  .toast {
    position: relative;
    animation: toastIn;
    animation-duration: .5s;
    cursor: pointer;
  }

  @keyframes toastIn {
   0% {
    transform: translateX(200%);
   }
   100% {
    transform: translateX(0);
   }
  }
  


</style>