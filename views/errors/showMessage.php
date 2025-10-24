<div class="bg-white dark-bg d-flex justify-content-center align-items-center vh-100 px-5">
    <div class="border shadow-sm p-4">
        <h1 class="display-6 font-weight-bold pb-3">Oops! Looks like there was a problem :\</h1>
        <ul class="px-4">
            <?= isset($message) ? $message : '<li> There was an unknown error. Contact support! </li>' ?>
        </ul>
    </div>
</div>