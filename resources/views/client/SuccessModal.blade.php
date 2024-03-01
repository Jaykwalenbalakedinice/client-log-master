<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #ffb980">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa-solid fa-circle-exclamation"></i> Logged out successfully </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
            <h4>Please help us improve our services by providing your feedback.</h4>
            <a href="http://20.20.23.71:8000/feedback-client/public/feedback?logsNumber={{session('logsNumber')}}" class="btn btn-success btn-lg mt-5">Click Me</a>
      </div>
    </div>
  </div>
</div>