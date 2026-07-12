<?php

declare(strict_types=1);

namespace App\Traits;

use CodeIgniter\HTTP\RedirectResponse;

trait RespostasTrait
{
    protected function sucesso(string $mensagem, string $url): RedirectResponse
    {
        return redirect()->to($url)->with('sucesso', $mensagem);
    }

    protected function erro(string $mensagem, ?string $url = null): RedirectResponse
    {
        $url = $url ?? $this->request->getServer('HTTP_REFERER') ?? '/';
        return redirect()->to($url)->with('erro', $mensagem);
    }

    protected function atencao(string $mensagem, ?string $url = null): RedirectResponse
    {
        $url = $url ?? $this->request->getServer('HTTP_REFERER') ?? '/';
        return redirect()->to($url)->with('atencao', $mensagem);
    }
}
