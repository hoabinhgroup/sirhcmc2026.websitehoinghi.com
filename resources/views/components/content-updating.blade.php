@props([
    'text' => 'Nội dung sẽ được cập nhật sau.',
])

<p {{ $attributes->class(['f-para']) }}>
  {{ $text }}
</p>
