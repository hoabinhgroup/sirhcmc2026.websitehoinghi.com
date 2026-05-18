@php
  $membersVi = [
    [
      'name' => 'TS.BS. NGUYỄN ĐÌNH LUÂN',
      'image' => 'img/organizing-committee/nguyen-dinh-luan.jpg',
      'role' => 'CHỦ TỊCH HỘI ĐIỆN QUANG CAN THIỆP HỒ CHÍ MINH',
    ],
    [
      'name' => 'BSCKII. TRẦN THANH VŨ',
      'image' => 'img/organizing-committee/tran-thanh-vu.jpg',
      'role' => 'PHÓ CHỦ TỊCH HỘI ĐIỆN QUANG CAN THIỆP HỒ CHÍ MINH',
    ],
    [
      'name' => 'BSCKII. NGUYỄN HUỲNH NHẤT TUẤN',
      'image' => 'img/organizing-committee/nguyen-huynh-nhat-tuan.jpg',
      'role' => 'TỔNG THƯ KÝ HỘI ĐIỆN QUANG CAN THIỆP HỒ CHÍ MINH',
    ],
  ];

  $membersEn = [
    [
      'name' => 'DR. NGUYEN DINH LUAN',
      'image' => 'img/organizing-committee/nguyen-dinh-luan.jpg',
      'role' => 'PRESIDENT OF SIRHCM',
    ],
    [
      'name' => 'DR. TRAN THANH VU',
      'image' => 'img/organizing-committee/tran-thanh-vu.jpg',
      'role' => 'VICE PRESIDENT OF SIRHCM',
    ],
    [
      'name' => 'DR. NGUYEN HUYNH NHAT TUAN',
      'image' => 'img/organizing-committee/nguyen-huynh-nhat-tuan.jpg',
      'role' => 'GENERAL SECRETARY SIRHCM',
    ],
  ];
@endphp
@extends('layout.index')
@section('title', 'SIR HCMC 2026 — Organizing Committee')
@section('content')
  @include('pages.about.partials.breadcrumb', ['breadcrumbCurrent' => 'Organizing Committee'])

  <section id="organizing-committee" class="about-section spad" x-data="{ lang: 'vi' }">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Ban tổ chức / Organizing Committee</h2>
          </div>
          <div class="switch-language oc-switch-language">
            <button @click="lang = 'vi'" :class="{ 'active': lang === 'vi' }" class="button-vietnam" type="button">Tiếng Việt</button>
            <button @click="lang = 'en'" :class="{ 'active': lang === 'en' }" class="button-english" type="button">English</button>
          </div>
          <div x-show="lang === 'vi'" x-cloak>
            @include('pages.about.partials.organizing-committee-grid', ['members' => $membersVi])
          </div>
          <div x-show="lang === 'en'" x-cloak>
            @include('pages.about.partials.organizing-committee-grid', ['members' => $membersEn])
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
