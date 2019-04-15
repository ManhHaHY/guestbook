<?php view('header', $data); ?>
<?php view('_nav', $data); ?>
<div class="container-fluid h-100">
    <div class="row h-100">
        <nav class="col-md-3 col-lg-3 col-xl-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <p class="px-5 text-justify">
                    Feel free to leave us a short message to tell us what you think to our services.
                </p>
                <p class="px-5">
                    <button class="btn text-light bg-danger w-100" data-toggle="modal" data-target="#newMessageModal">Post a Message</button>
                </p>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 col-xl-10 px-4 bg-dark text-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h2>Messages</h2>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="newMessageModal" tabindex="-1" role="dialog" aria-labelledby="submitNewMessage" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMessageModalLabel">Send New Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="visitor-name" class="col-form-label">Visitor name:</label>
                        <input type="text" class="form-control" id="visitor-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitNewMessage" 
                data-loading-text='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'>Submit</button>
            </div>
        </div>
    </div>
</div>
<?php view('footer'); ?>