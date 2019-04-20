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
                    <button class="btn text-light bg-danger w-100 btnPostNewMessage" data-toggle="modal" data-target="#newMessageModal">Post a Message</button>
                </p>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 col-xl-10 px-4 bg-dark text-light">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h2>Messages</h2>
            </div>
            <div class="card-columns">
                <?php if(count($data['messages']) > 0): ?>
                <?php foreach($data['messages'] as $message): ?>
                <div class="card bg-dark">
                    <div class="card-block quote-card">
                        <div class="card-text">
                            <span class="pl-2 message" data-id="<?php echo $message['id']?>">
                                <?php echo $message['message']?>
                            </span>
                        </div>
                        <div class="meta">
                            <span class="visitor-name pl-2" data-id="<?php echo $message['id']?>">
                                <?php echo $message['visitor_name']?>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small><?php echo date('dS M, Y', strtotime($message['created_at'])) 
                        . ' at ' . date('H:i A', strtotime($message['created_at'])) ?></small>
                        <?php if (isset($_SESSION['username'])): ?>
                        <button class="btn btn-circle btn-danger float-right btn-sm ml-1 delete-message" data-id="<?php echo $message['id']?>">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="btn btn-circle btn-danger float-right btn-sm edit-message" data-id="<?php echo $message['id']?>"
                            data-toggle="modal" data-target="#newMessageModal">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <?php endif;?>
                    </div>
                </div>
                <?php endforeach;;?>
                <?php endif;?>
            </div>
            <?php if($data['totalPages'] > 0):?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center custom-pagination">
                    <?php if($data['prevPage'] != ''):?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo '?page=' . $data['prevPage']?>" aria-label="Previous">
                            <span aria-hidden="true">&lt;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php endif;?>
                    <?php for($i = 1;$i <= $data['totalPages'];$i++):?>
                    <li class="page-item <?php echo ($i == $data['currentPage'] ? 'active' : '')?>">
                        <a class="page-link" href="<?php echo "?page=$i"; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php endfor;?>
                    <?php if($data['nextPage'] != ''):?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo '?page=' . $data['nextPage']?>" aria-label="Next">
                            <span aria-hidden="true">&gt;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <?php endif;?>
                </ul>
            </nav>
            <?php endif;?>
        </main>
    </div>
</div>

<!-- Modal Add Message -->
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
                <ul class="alert" style="display: none;">
                </ul>
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
                <input type="hidden" id="editMessageId">
                <button type="button" class="btn btn-secondary close-message-form" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitNewMessage" 
                data-loading-text='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...'>Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal confirm delete-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteMessageModal" aria-hidden="true" id="deleteMessageModal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Do you wanna delete this message?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="deleteMessageId" />
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="modal-btn-yes">Yes</button>
      </div>
    </div>
  </div>
</div>
<?php view('footer'); ?>