<?php

namespace Tests\Feature;

use Tests\TestCase;

class MailPreviewTest extends TestCase
{
    public function test_mail_preview_renders_both_confirmation_emails(): void
    {
        $response = $this->get(route('dev.mail-preview'));

        $response->assertOk();
        $response->assertSee('Nộp abstract thành công');
        $response->assertSee('Đăng ký thành công');
        $response->assertSee('Xác nhận nộp abstract SIRHCM 2026');
        $response->assertSee('Xác nhận đăng ký & hướng dẫn chuyển khoản SIRHCM 2026');
        $response->assertSee('Trần Thị B');
        $response->assertSee('Nguyễn Văn A');
        $response->assertSee('dh.qt2@hoabinh-group.com');
        $response->assertSee('minhphamquang028@gmail.com');
    }
}
