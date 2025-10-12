<div class="bg-white dark-bg d-flex justify-content-center align-items-center vh-100 px-5">
    <div class="border shadow-sm p-4">
        <h1 class="display-6 font-weight-bold pb-3">Oops! Parece que houve um problema :\</h1>
        <ul class="px-4">
            <?= isset($message) ? $message : '<li> Houve um erro desconhecido. Contate o suporte! </li>' ?>
        </ul>
    </div>
</div>