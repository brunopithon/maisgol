<x-mail::message>
# Redefinir senha



<x-mail::button :url="$url">
Resetar senha
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
