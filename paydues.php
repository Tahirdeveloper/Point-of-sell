
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pay Dues</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Amount:</label>
                  <input type="text" class="form-control" id="amount" name="amount" placeholder="00">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="pay" id="pay">Pay</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
</html>