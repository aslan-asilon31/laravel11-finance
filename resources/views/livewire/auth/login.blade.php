<x-form wire:submit.prevent="login" class="space-y-4">
    <x-input
        type="email"
        wire:model="email"
        label="Email"
        placeholder="Enter your email"
        icon-right="o-user"
        right
    />

    <x-password
        wire:model="password"
        label="Password"
        placeholder="Enter your password"
        password-icon="o-lock-closed"
        password-visible-icon="o-lock-open"
        right
    />

    <x-button
        type="submit"
        spinner="login"
        class="btn-success"
        label="Login"
    />
</x-form>
