---
document_type: business_requirements_document
project: SIRHCM2026 Registration & Abstract Submission Forms
version: "1.0"
created_date: "2026-06-26"
language: vi-VN
primary_use: "AI context / business analysis for building registration and abstract submission forms"
event_name_vi: "Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM2026)"
event_name_en: "The Society of Interventional Radiology Annual Scientific Meeting 2nd (SIRHCM2026)"
event_dates: "2026-10-16 to 2026-10-17"
event_venue: "Pullman Vung Tau, Viet Nam"
timezone: "GMT+7 / Asia/Bangkok"
currency: "VND"
conference_email: "sirhcm2024@gmail.com"
support_phone_zalo: "+84 772 649 011"
source_files:
  - "4. SIRHCMC 2026 - Registration VIE.docx"
  - "4. SIRHCM2026 - Registration EN.docx"
  - "5. Abstract Submission - VN.docx"
  - "5. Abstract Submission - EN.docx"
---

# BRD - Phân tích nghiệp vụ form đăng ký & nộp bài SIRHCM2026

> Tài liệu này được tối ưu để đưa cho AI/dev đọc làm context khi sinh code, thiết kế database, viết validation, tạo email template, hoặc phân tích luồng nghiệp vụ.  
> Quy ước: các mục ghi "theo tài liệu gốc" là requirement đã có trong file đầu vào; các mục ghi "đề xuất" là phần phân tích bổ sung để triển khai hệ thống rõ hơn.

## AI usage guide

Khi dùng tài liệu này để yêu cầu AI tạo code hoặc form, hãy coi đây là nguồn ngữ cảnh chính cho nghiệp vụ SIRHCM2026. AI cần ưu tiên các rule sau:

1. Có 2 module chính: `registration` và `abstract_submission`.
2. Mỗi module có 2 biến thể: `domestic/vi` và `international/en`.
3. Tất cả khoản thanh toán dùng tiền tệ `VND`.
4. Giá ưu đãi phụ thuộc vào **ngày thanh toán thực tế**, không chỉ ngày submit form.
5. Backend phải tự tính phí lại, không tin `total_amount` gửi từ frontend.
6. Các vấn đề trong phần "Điểm cần xác nhận với BTC" chưa được xem là chốt cuối.
7. Khi build hệ thống, nên tách cấu hình deadline, giá, bank info, email template ra khỏi code cứng.

## Quick summary for AI

- Event: SIRHCM2026, diễn ra ngày 16-17/10/2026 tại Pullman Vũng Tàu.
- Registration deadline early bird: trước/đến 15/09/2026; standard từ 16/09/2026.
- Abstract submission deadline: 01/09/2026 23:59 GMT+7.
- Abstract acceptance announcement: 15/09/2026.
- Refund/cancellation deadline: đến hết 05/10/2026.
- Payment methods: online card payment có 6% transaction fee, hoặc bank/wire transfer.
- Fee waiver categories: SIRHCM Member, Oral Presentation, Poster Presentation; tài liệu cũng có nhánh Plenary/Invited Speakers cần xác nhận/map thêm.
- Gala Dinner ngày 17/10/2026: 800.000 VND nếu chọn.

| **Thông tin**   | **Nội dung**                                                              |
|-----------------|---------------------------------------------------------------------------|
| Phiên bản       | 1.0                                                                       |
| Ngày lập        | 26/06/2026                                                                |
| Sự kiện         | Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM2026) |
| Thời gian       | 16 - 17/10/2026                                                           |
| Địa điểm        | Pullman Vũng Tàu / Pullman Vung Tau, Viet Nam                             |
| Email hội nghị  | sirhcm2024@gmail.com                                                      |
| SĐT/Zalo hỗ trợ | 0772 649 011 / +84 772 649 011                                            |

## Nguồn tài liệu đầu vào

| **#** | **File**                                 | **Vai trò**                                                                             |
|--------|------------------------------------------|-----------------------------------------------------------------------------------------|
| 1      | 4\. SIRHCMC 2026 - Registration VIE.docx | Form đăng ký tham dự cho đại biểu trong nước, phí, thanh toán, phản hồi website, email. |
| 2      | 4\. SIRHCM2026 - Registration EN.docx    | Form registration cho đại biểu quốc tế, phí, thanh toán, phản hồi website, email.       |
| 3      | 5\. Abstract Submission - VN.docx        | Form nộp abstract cho báo cáo viên trong nước.                                          |
| 4      | 5\. Abstract Submission - EN.docx        | Form abstract submission cho báo cáo viên quốc tế.                                      |

> **Ghi chú:** Tài liệu này tách phần “yêu cầu chắc chắn theo file gốc” và phần “khuyến nghị triển khai” để tránh nhầm giữa requirement đã có và điểm cần xác nhận thêm.

# 1. Phạm vi nghiệp vụ

- Xây dựng 02 module form chính: Đăng ký tham dự hội nghị và Nộp bài báo cáo tóm tắt/Abstract Submission.

- Mỗi module có 02 biến thể: Trong nước/Vietnamese và Quốc tế/English.

- Hệ thống cần tạo mã đăng ký/mã submission, lưu hồ sơ, tính phí, xử lý online payment hoặc hướng dẫn chuyển khoản, gửi email xác nhận và hỗ trợ quản trị/export.

- Đồng tiền thanh toán: VND cho tất cả đại biểu.

- Sau khi thanh toán đầy đủ, BTC gửi xác nhận chính thức, thư mời và/hoặc e-receipt qua email.

## 1.1 Các actor chính

| **Actor**              | **Nhiệm vụ**                                                                                                 |
|------------------------|--------------------------------------------------------------------------------------------------------------|
| Đại biểu/Delegate      | Điền form đăng ký, chọn loại đại biểu, chọn gala, chọn thanh toán, nhận email/mã đăng ký.                    |
| Báo cáo viên/Presenter | Nộp abstract, CV, ảnh chân dung, bằng cấp nếu có yêu cầu, nhận email xác nhận.                               |
| Ban Thư ký/Secretariat | Theo dõi hồ sơ, xác minh thanh toán/chứng từ, xử lý hủy/hoàn tiền, hỗ trợ email/Zalo.                        |
| Admin hệ thống         | Quản lý dữ liệu, cấu hình phí, export Excel, gửi lại email, cập nhật trạng thái payment/submission/check-in. |
| Payment gateway        | Xử lý online payment thẻ Visa/MasterCard/JCB/American Express và trả trạng thái thành công/thất bại/hủy.     |

## 1.2 Module nên có trên website

| **Route/Module**     | **Tên**                     | **Mô tả**                                                                                      |
|----------------------|-----------------------------|------------------------------------------------------------------------------------------------|
| /registration        | Đăng ký tham dự hội nghị    | Chọn Domestic/International hoặc tự động theo ngôn ngữ site; tính phí; thanh toán.             |
| /abstract-submission | Nộp bài báo cáo tóm tắt     | Chọn Domestic/International; nhập thông tin; upload abstract/CV/headshot/degree; gửi xác nhận. |
| /payment/success     | Trang thanh toán thành công | Hiển thị thông báo thành công, nhắc kiểm tra email/spam.                                       |
| /payment/cancel      | Trang hủy thanh toán        | Thông báo giao dịch bị hủy nhưng hồ sơ đã được gửi cho BTC.                                    |
| /payment/failed      | Trang thanh toán thất bại   | Thông báo thất bại, hướng dẫn liên hệ BTC.                                                     |
| /admin/registrations | Quản trị đăng ký            | Tra cứu, lọc, export, cập nhật thanh toán, check-in, gửi lại email.                            |
| /admin/abstracts     | Quản trị abstract           | Tra cứu, lọc chủ đề, tải file, cập nhật trạng thái review/accepted/rejected/withdrawn.         |

# 2. Mốc thời gian và chính sách

| **Mốc**                      | **Thời gian**                   | **Rule nghiệp vụ**                                                                                          |
|------------------------------|---------------------------------|-------------------------------------------------------------------------------------------------------------|
| Đăng ký sớm/Early bird       | Trước hoặc đến hết 15/09/2026   | Áp dụng theo ngày thanh toán thực tế, không chỉ ngày submit form.                                           |
| Đăng ký tiêu chuẩn/on-site   | Từ 16/09/2026 đến ngày hội nghị | Nếu không thanh toán trước deadline, hồ sơ có thể chuyển sang mức phí tại thời điểm đăng ký/thanh toán lại. |
| Hội nghị                     | 16 - 17/10/2026                 | Địa điểm Pullman Vũng Tàu.                                                                                  |
| Gala Dinner                  | 17/10/2026                      | Phụ phí 800.000 VND nếu chọn.                                                                               |
| Hạn nộp abstract             | 01/09/2026 23:59 GMT+7          | Sau hạn nên khóa submit hoặc hiển thị thông báo hết hạn.                                                    |
| Thông báo chấp nhận abstract | 15/09/2026                      | Có thể dùng để gửi email accepted/rejected sau khi review.                                                  |
| Hủy/hoàn tiền                | Đến hết 05/10/2026              | Sau 05/10/2026 không xử lý hủy/hoàn tiền.                                                                   |

# 3. Phân tích phí đăng ký tham dự

| **Loại phí/đại biểu**                     | **Early trước 15/09/2026 (VND)** | **Từ 16/09/2026 & On-site (VND)** | **Ghi chú**      |
|-------------------------------------------|----------------------------------|-----------------------------------|------------------|
| Physician / Bác sĩ không phải thành viên  | 1.000.000                        | 2.000.000                         | Không            |
| Allied health / Nhân viên hỗ trợ y tế     | 800.000                          | 1.200.000                         | Không            |
| SIRHCM Member / Hội viên SIRHCM           | 0                                | 0                                 | Miễn phí         |
| Oral Presentation / Báo cáo viên Oral     | 0                                | 0                                 | Miễn phí         |
| Poster Presentation / Báo cáo viên Poster | 0                                | 0                                 | Miễn phí         |
| Gala Dinner 17/10/2026                    | 800.000                          | 800.000                           | Phụ phí/tùy chọn |

## 3.1 Công thức tính phí đề xuất

| **Biến**               | **Logic**                                                                       | **Ghi chú**                                                                                                    |
|------------------------|---------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------|
| price_period           | early nếu payment_date \<= 2026-09-15; standard nếu payment_date \>= 2026-09-16 | Dựa trên ngày thanh toán thực tế.                                                                              |
| base_fee               | Tra theo delegate_category và price_period                                      | SIRHCM Member/Oral/Poster = 0.                                                                                 |
| gala_fee               | 800.000 nếu gala_dinner = true, ngược lại 0                                     | Cần chốt nếu nhóm fee waiver có được miễn Gala hay không.                                                      |
| subtotal               | base_fee + gala_fee                                                             | Hiển thị trước khi chọn payment.                                                                               |
| online_transaction_fee | subtotal \* 6% nếu payment_method = online                                      | Chưa rõ cách làm tròn; đề xuất round tới VND.                                                                  |
| total_amount           | subtotal + online_transaction_fee                                               | Nếu payment_method = bank_transfer thì fee giao dịch = 0 trên hệ thống; phí ngân hàng do người chuyển tự chịu. |

> **Ghi chú:** Tài liệu gốc ghi ưu đãi dựa trên ngày thanh toán thực tế. Vì vậy hệ thống không nên “chốt giá sớm” chỉ vì user submit trước 15/09/2026 nếu sau đó chưa thanh toán.

## 3.2 Phương thức thanh toán

| **Phương thức**    | **Thông tin**                                                                                                                                                              | **Luồng trạng thái**                                                                                             |
|--------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------|
| Online Payment     | Visa, MasterCard, JCB, American Express; cộng 6% phí giao dịch.                                                                                                            | submitted -\> payment_redirected -\> payment_success/payment_failed/payment_cancelled -\> confirmed nếu success. |
| Bank/Wire Transfer | Chuyển khoản tới Công ty TNHH đầu tư thương mại và du lịch Quốc tế Hòa Bình, STK 1112 0846 228 011, SWIFT VTCBVNVX, Bank code 01310001, Techcombank CN Thăng Long, Hà Nội. | submitted -\> payment_pending -\> admin xác nhận -\> confirmed/receipt_sent.                                     |

# 4. Ma trận trường dữ liệu cho form

## 4.1 Form đăng ký tham dự - Đại biểu trong nước

| **Module** | **Label**                | **Field key**       | **Kiểu**                  | **Bắt buộc**     | **Rule/Ghi chú**                                                                                                         |
|------------|--------------------------|---------------------|---------------------------|------------------|--------------------------------------------------------------------------------------------------------------------------|
| Đăng ký VN | Chức danh                | title               | radio/select + other_text | Có               | Options: GS.TS., PGS.TS., TS., BSCKI., BSCKII., BS., Khác. Nếu chọn Khác bắt buộc nhập other_title.                      |
| Đăng ký VN | Họ và tên                | full_name           | text                      | Có               | Nên chuẩn hóa trim, viết hoa đầu từ hoặc giữ nguyên input.                                                               |
| Đăng ký VN | Đơn vị công tác          | affiliation         | text                      | Có               | Dùng trong email xác nhận và export.                                                                                     |
| Đăng ký VN | Chức vụ                  | position            | text                      | Không            | Không bắt buộc theo tài liệu.                                                                                            |
| Đăng ký VN | Ngày tháng năm sinh      | date_of_birth       | date                      | Có               | Định dạng UI: DD/MM/YYYY. Lưu DB dạng date.                                                                              |
| Đăng ký VN | Số điện thoại            | phone               | tel                       | Có               | Validate số điện thoại VN; cho phép +84.                                                                                 |
| Đăng ký VN | Địa chỉ email            | email               | email                     | Có               | Dùng làm kênh nhận email xác nhận, mã đăng ký, biên lai.                                                                 |
| Đăng ký VN | Bằng cấp phục vụ cấp CME | degree_file         | file                      | Có               | Tài liệu gốc yêu cầu tải file. Nên cho phép PDF/JPG/PNG/DOC/DOCX, giới hạn dung lượng cần chốt.                          |
| Đăng ký VN | Ăn kiêng                 | dietary_requirement | select + other_text       | Không            | Options: Không có, Ăn chay, Khác. Nếu Khác bắt buộc nhập dietary_other.                                                  |
| Đăng ký VN | Loại đại biểu/phí        | delegate_category   | radio                     | Có               | Options tính phí: bác sĩ không phải thành viên SIRHCM, nhân viên hỗ trợ y tế, hội viên SIRHCM, báo cáo viên Poster/Oral. |
| Đăng ký VN | Gala Dinner 17/10/2026   | gala_dinner         | checkbox                  | Không            | Nếu chọn cộng 800.000 VND, trừ trường hợp BTC xác nhận miễn phí toàn bộ.                                                 |
| Đăng ký VN | Phương thức thanh toán   | payment_method      | radio                     | Có nếu tổng \> 0 | Online hoặc chuyển khoản. Nếu tổng = 0 có thể bỏ qua thanh toán và chuyển sang confirmed/fee_waived.                     |

## 4.2 Form registration - International delegates

| **Module**      | **Label**                   | **Field key**       | **Type**                  | **Required**                 | **Rule/Note**                                                                                                                          |
|-----------------|-----------------------------|---------------------|---------------------------|------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|
| Registration EN | Title                       | title               | radio/select + other_text | Yes                          | Options: Prof., Dr., MSc., BSc., Mr., Ms., Other. If Other, require other_title.                                                       |
| Registration EN | Full name                   | full_name           | text                      | Yes                          | Used in registration ID email and payment reference.                                                                                   |
| Registration EN | Affiliation                 | affiliation         | text                      | Yes                          | Used in email and export.                                                                                                              |
| Registration EN | Position                    | position            | text                      | No                           | Optional.                                                                                                                              |
| Registration EN | Country/Region              | country_region      | text/select               | Yes                          | Recommend country dropdown + free text fallback.                                                                                       |
| Registration EN | Mobile number               | mobile_number       | tel                       | No in source / recommend Yes | Source has no star. Recommend requiring it because transfer reference/contact support uses phone in overview.                          |
| Registration EN | Email address               | email               | email                     | Yes                          | Required for confirmation, receipt and invitation.                                                                                     |
| Registration EN | Special dietary requirement | dietary_requirement | select + other_text       | No                           | Options: None, Halal, Vegetarian, Other. If Other, require dietary_other.                                                              |
| Registration EN | Conference type             | delegate_category   | radio                     | Yes                          | Physician, Allied health, SIRHCM Member, Oral Presentation, Poster Presentation. Need confirm if Plenary/Invited Speakers is separate. |
| Registration EN | Gala Dinner                 | gala_dinner         | checkbox                  | No                           | If selected, add 800.000 VND.                                                                                                          |
| Registration EN | Payment method              | payment_method      | radio                     | Yes if amount \> 0           | Online Payment or Wire Transfer.                                                                                                       |

## 4.3 Form nộp abstract - Báo cáo viên trong nước

| **Module**  | **Label**            | **Field key**       | **Kiểu**                  | **Bắt buộc** | **Rule/Ghi chú**                                                                                                   |
|-------------|----------------------|---------------------|---------------------------|--------------|--------------------------------------------------------------------------------------------------------------------|
| Abstract VN | Chủ đề               | abstract_category   | checkbox/radio            | Có           | 26 chủ đề. Khuyến nghị chọn 1 chủ đề chính; nếu cho nhiều chủ đề cần chỉnh logic review.                           |
| Abstract VN | Chức danh            | title               | radio/select + other_text | Có           | GS.TS., PGS.TS., TS., BSCKI., BSCKII., BS., Khác.                                                                  |
| Abstract VN | Họ và tên            | full_name           | text                      | Có           | Thông tin người nộp/người trình bày.                                                                               |
| Abstract VN | Đơn vị công tác      | affiliation         | text                      | Có           | Dùng trong hồ sơ abstract và export.                                                                               |
| Abstract VN | Chức vụ              | position            | text                      | Không        | Optional.                                                                                                          |
| Abstract VN | Ngày tháng năm sinh  | date_of_birth       | date                      | Có           | DD/MM/YYYY.                                                                                                        |
| Abstract VN | Số Căn cước công dân | citizen_id          | text                      | Có           | Validate 12 số nếu áp dụng CCCD Việt Nam.                                                                          |
| Abstract VN | Số điện thoại        | phone               | tel                       | Có           | Validate số điện thoại.                                                                                            |
| Abstract VN | Địa chỉ email        | email               | email                     | Có           | Bắt buộc để gửi phản hồi.                                                                                          |
| Abstract VN | CV                   | cv_file             | file                      | Có           | Tải file CV.                                                                                                       |
| Abstract VN | Ảnh chân dung        | headshot_file       | file/image                | Có           | Tải ảnh chân dung.                                                                                                 |
| Abstract VN | Bài báo cáo tóm tắt  | abstract_file       | file                      | Có           | Tối thiểu 500 từ, tối đa 1000 từ theo quy định; nếu chỉ upload file thì hệ thống khó validate word count realtime. |
| Abstract VN | Bằng cấp phục vụ CME | degree_file         | file                      | Có           | Tải file bằng cấp.                                                                                                 |
| Abstract VN | Ăn kiêng             | dietary_requirement | select + other_text       | Không        | Không có, Ăn chay, Khác.                                                                                           |

## 4.4 Abstract submission - International presenters

| **Module**  | **Label**                   | **Field key**       | **Type**                  | **Required**                 | **Rule/Note**                                                                                                     |
|-------------|-----------------------------|---------------------|---------------------------|------------------------------|-------------------------------------------------------------------------------------------------------------------|
| Abstract EN | Abstract Category           | abstract_category   | checkbox/radio            | Yes                          | 26 categories. Recommend single primary category unless review process needs multiple categories.                 |
| Abstract EN | Title                       | title               | radio/select + other_text | Yes                          | Prof., Dr., MSc., BSc., Mr., Ms., Other.                                                                          |
| Abstract EN | Full name                   | full_name           | text                      | Yes                          | Presenter/submitter name.                                                                                         |
| Abstract EN | Affiliation                 | affiliation         | text                      | Yes                          | Used for review/export.                                                                                           |
| Abstract EN | Position                    | position            | text                      | No                           | Optional.                                                                                                         |
| Abstract EN | Country/Region              | country_region      | text/select               | Yes                          | International presenter country/region.                                                                           |
| Abstract EN | Mobile number               | mobile_number       | tel                       | No in source / recommend Yes | Source has no star, but should be required for contact.                                                           |
| Abstract EN | Email address               | email               | email                     | Missing in source / must add | The source does not list an email field, while the workflow requires confirmation email. Add as required.         |
| Abstract EN | Abstract submission file    | abstract_file       | file                      | Yes                          | Attached file. Apply 500-1000 words rule if validation is technically supported.                                  |
| Abstract EN | CV                          | cv_file             | file                      | Yes                          | Attached file.                                                                                                    |
| Abstract EN | Headshot                    | headshot_file       | file/image                | Unclear                      | Source lists HEADSHOT without asterisk. VN version requires it. Need confirm; recommend required for consistency. |
| Abstract EN | Special dietary requirement | dietary_requirement | select + other_text       | No                           | None, Halal, Vegetarian, Other.                                                                                   |

## 4.5 Danh sách chủ đề abstract

| **#** | **Abstract category**                             |
|--------|---------------------------------------------------|
| 1      | Artificial intelligence (AI)                      |
| 2      | Biliary intervention                              |
| 3      | Biopsy and drainage                               |
| 4      | Bone, spine and soft tissue intervention          |
| 5      | Chemoembolization (TACE)                          |
| 6      | Dialysis intervention and venous access           |
| 7      | Embolotherapy (excluding oncology)                |
| 8      | EVAR and TEVAR                                    |
| 9      | Experimental work in IR                           |
| 10     | GI tract intervention                             |
| 11     | IVC filters                                       |
| 12     | Management in IR (including clinical practice)    |
| 13     | Neuro and/or carotid intervention                 |
| 14     | Non-thermal ablation (including IRE)              |
| 15     | Pain management                                   |
| 16     | Peripheral vascular disease intervention          |
| 17     | Radiation safety and sustainability               |
| 18     | Radioembolization (TARE)                          |
| 19     | Renal and visceral artery intervention            |
| 20     | Thermal ablation                                  |
| 21     | TIPS and portal vein intervention                 |
| 22     | Trauma embolization                               |
| 23     | Urinary tract intervention                        |
| 24     | Vascular malformations and lymphatic intervention |
| 25     | Venous intervention                               |
| 26     | Others                                            |

# 5. Luồng xử lý nghiệp vụ

## 5.1 Luồng đăng ký tham dự có phí

1.  User mở form Registration, chọn Domestic/International hoặc ngôn ngữ tương ứng.

2.  User nhập thông tin chung, chọn loại đại biểu, chọn Gala nếu có.

3.  Hệ thống tính base_fee, gala_fee, transaction_fee nếu thanh toán online, total_amount.

4.  User chọn payment_method.

5.  Submit form: hệ thống validate, tạo registration_id, lưu record và attachment.

6.  Nếu Online Payment: redirect sang cổng thanh toán, nhận callback/trạng thái success/failed/cancel.

7.  Nếu Wire/Bank Transfer: hiển thị hướng dẫn chuyển khoản và gửi email instruction.

8.  Sau khi payment_success hoặc admin xác nhận chuyển khoản: chuyển trạng thái confirmed, gửi confirmation/invitation/e-receipt nếu đã sẵn sàng.

9.  Admin dùng registration_id để check-in, export và đối soát.

## 5.2 Luồng đăng ký miễn phí/fee waiver

10. User chọn nhóm miễn phí: SIRHCM Member, Oral Presentation, Poster Presentation hoặc Plenary/Invited Speakers nếu BTC xác nhận có option này.

11. Hệ thống tính base_fee = 0. Nếu user chọn Gala, cần xử lý theo rule đã chốt: miễn toàn bộ hay vẫn thu 800.000 VND.

12. Nếu total_amount = 0: bỏ qua bước thanh toán, trạng thái fee_waived/confirmed_pending_review hoặc confirmed.

13. Gửi email xác nhận miễn phí theo template tương ứng.

## 5.3 Luồng nộp abstract

14. User mở Abstract Submission, chọn Domestic/International.

15. User chọn abstract_category, nhập thông tin cá nhân và upload các file bắt buộc.

16. Hệ thống kiểm tra deadline 01/09/2026 23:59 GMT+7. Sau deadline nên khóa form hoặc chuyển sang trạng thái late_submission nếu BTC cho phép.

17. Submit: hệ thống tạo submission_id, lưu hồ sơ và file upload.

18. Gửi email/hiển thị thông báo đã nhận hồ sơ.

19. Admin/reviewer lọc theo category, tải abstract/CV/headshot/degree, cập nhật trạng thái under_review/accepted/rejected/withdrawn.

20. Trước ngày 15/09/2026 hoặc đúng ngày công bố, BTC gửi thông báo kết quả accepted/rejected.

# 6. Trạng thái dữ liệu nên dùng

| **Registration status** | **Ý nghĩa**                                              |
|-------------------------|----------------------------------------------------------|
| submitted               | Đã submit form, chưa xử lý thanh toán.                   |
| payment_redirected      | Đã chuyển sang cổng online payment.                      |
| payment_success         | Cổng thanh toán trả thành công.                          |
| payment_failed          | Thanh toán online thất bại.                              |
| payment_cancelled       | User hủy thanh toán online.                              |
| payment_pending         | Chờ chuyển khoản hoặc chờ admin đối soát.                |
| paid_manual             | Admin đã xác nhận chuyển khoản.                          |
| confirmed               | Hồ sơ hợp lệ, đã xác nhận tham dự.                       |
| receipt_sent            | Đã gửi biên lai/e-receipt.                               |
| cancel_requested        | User yêu cầu hủy trước deadline.                         |
| cancelled               | Đã hủy hồ sơ.                                            |
| refund_pending          | Đang xử lý hoàn tiền.                                    |
| refunded                | Đã hoàn tiền.                                            |
| onsite_converted        | Chuyển sang đăng ký tại chỗ do thiếu giấy tờ/thanh toán. |

| **Abstract status**        | **Ý nghĩa**                               |
|----------------------------|-------------------------------------------|
| submitted                  | Đã nộp abstract.                          |
| under_review               | Đang review.                              |
| accepted                   | Được chấp nhận.                           |
| rejected                   | Không được chấp nhận.                     |
| revision_requested         | Yêu cầu chỉnh sửa/bổ sung.                |
| withdraw_requested         | Tác giả yêu cầu rút bài trước 01/09/2026. |
| withdrawn                  | Đã rút bài.                               |
| presenter_change_requested | Yêu cầu đổi người trình bày.              |

# 7. Validation và ràng buộc kỹ thuật

| **Nhóm validation** | **Yêu cầu**                                                                                                                       |
|---------------------|-----------------------------------------------------------------------------------------------------------------------------------|
| Required fields     | Tất cả trường có dấu \* trong tài liệu phải validate bắt buộc. Riêng Abstract EN cần bổ sung email bắt buộc dù tài liệu chưa ghi. |
| Email               | Validate định dạng email; normalize lowercase; dùng làm unique mềm theo form + event nếu cần.                                     |
| Phone/Mobile        | Cho phép số VN và quốc tế; strip khoảng trắng; lưu kèm country code nếu có.                                                       |
| Date of birth       | Không cho ngày tương lai; lưu ISO date.                                                                                           |
| CCCD                | Với form VN Abstract: nên validate 12 chữ số; cho phép override nếu người nước ngoài trong nhóm VN? cần chốt.                     |
| File upload         | Nên cho phép PDF, DOC, DOCX, JPG, PNG. Dung lượng/tổng dung lượng chưa nêu trong tài liệu, cần cấu hình.                          |
| Abstract word count | Rule 500-1000 từ. Nếu upload file: validate thủ công hoặc parser server. Nếu muốn chắc, thêm textarea nhập abstract body.         |
| Payment amount      | Không cho client tự gửi total; server tự tính lại dựa trên category/date/payment_method/gala.                                     |
| Deadline lock       | Sau 01/09/2026 khóa abstract submission; sau 15/09/2026 chuyển fee period sang standard/on-site.                                  |
| Spam prevention     | Nên thêm reCAPTCHA/hCaptcha, rate limit theo IP/email, honeypot hidden field.                                                     |

# 8. Nội dung phản hồi website và email

## 8.1 Màn hình phản hồi Registration

| **Trường hợp**                | **Nội dung cần hiển thị**                                                                                                                                             |
|-------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Free/Plenary/Invited Speakers | Cảm ơn đã đăng ký, thông báo sẽ nhận email xác nhận, liên hệ sirhcm2024@gmail.com nếu cần hỗ trợ.                                                                     |
| Online - Cancel               | Thông báo thanh toán bị hủy; thông tin vẫn đã được gửi cho BTC; hướng dẫn liên hệ email.                                                                              |
| Online - Success              | Thông báo thanh toán thành công; sẽ nhận email xác nhận giao dịch; nhắc kiểm tra spam để nhận receipt.                                                                |
| Online - Failed               | Thông báo thanh toán thất bại; hồ sơ đã gửi BTC; hướng dẫn liên hệ email.                                                                                             |
| Bank/Wire Transfer            | Cảm ơn đã đăng ký; hiển thị registration_id; hướng dẫn chuyển khoản với nội dung “Full name - Registration ID paid for SIRHCM2026”; yêu cầu gửi proof qua email/Zalo. |

## 8.2 Màn hình phản hồi Abstract

| **Ngôn ngữ** | **Nội dung**                                                                                                                                                                                  |
|--------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| VN           | Cảm ơn Quý Đại biểu đã đăng ký Hội nghị khoa học Điện Quang Can Thiệp Hồ Chí Minh lần thứ 2 (SIRHCM2026); sẽ nhận email xác nhận; liên hệ sirhcm2024@gmail.com nếu cần hỗ trợ.                |
| EN           | Thank you for registering for The Society of Interventional Radiology Annual Scientific Meeting 2nd; you will receive a confirmation email shortly; contact sirhcm2024@gmail.com for support. |

## 8.3 Email template cần cấu hình

| **Template key**              | **Mục đích**                               | **Biến dữ liệu cần có**                                                                                                      |
|-------------------------------|--------------------------------------------|------------------------------------------------------------------------------------------------------------------------------|
| registration_fee_waived_vi/en | Xác nhận đăng ký miễn phí                  | title + full_name, event, date, venue, affiliation, country/province, registration_id, email, conference type, total amount. |
| registration_online_vi/en     | Xác nhận thanh toán/đăng ký online         | title + full_name, event, date, venue, registration_id, conference type, total amount, payment type, payment link/status.    |
| registration_bank_vi/en       | Xác nhận đăng ký và hướng dẫn chuyển khoản | title + full_name, event, date, venue, registration_id, total amount, bank info, instruction gửi proof.                      |
| payment_success_vi/en         | Thông báo giao dịch thành công             | registration_id, amount, receipt info, support email.                                                                        |
| payment_failed_vi/en          | Thông báo giao dịch thất bại               | registration_id, retry/payment support link.                                                                                 |
| abstract_received_vi/en       | Xác nhận đã nhận abstract                  | submission_id, abstract category, full name, affiliation, email, deadline/results info.                                      |
| abstract_result_vi/en         | Thông báo kết quả abstract                 | accepted/rejected/revision, category, title/file name, instructions tiếp theo.                                               |

# 9. Đề xuất mô hình dữ liệu

| **Bảng**             | **Trường chính đề xuất**                                                                                                                                                                                                                                                                                                                                                    |
|----------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| registrations        | id, registration_id, locale, registration_scope, title, other_title, full_name, affiliation, position, date_of_birth, country_region, phone/mobile, email, degree_file_id, dietary_requirement, dietary_other, delegate_category, gala_dinner, price_period, base_fee, gala_fee, transaction_fee, total_amount, payment_method, status, submitted_at, paid_at, confirmed_at |
| payments             | id, registration_id, provider, payment_method, amount, currency, transaction_fee, gateway_transaction_id, bank_transfer_reference, proof_file_id, status, paid_at, raw_callback_json                                                                                                                                                                                        |
| abstract_submissions | id, submission_id, locale, presenter_scope, abstract_category, title, other_title, full_name, affiliation, position, date_of_birth, citizen_id, country_region, phone/mobile, email, dietary_requirement, dietary_other, status, submitted_at                                                                                                                               |
| attachments          | id, owner_type, owner_id, attachment_type, original_filename, stored_path, mime_type, size_bytes, uploaded_at                                                                                                                                                                                                                                                               |
| email_logs           | id, owner_type, owner_id, template_key, recipient_email, subject, status, sent_at, error_message                                                                                                                                                                                                                                                                            |
| admin_notes          | id, owner_type, owner_id, admin_id, note, created_at                                                                                                                                                                                                                                                                                                                        |
| checkins             | id, registration_id, checked_in_at, checked_in_by, badge_printed_at, materials_collected_at                                                                                                                                                                                                                                                                                 |
| settings/prices      | id, event_id, category, early_price, standard_price, gala_price, online_fee_percent, early_deadline, abstract_deadline, refund_deadline                                                                                                                                                                                                                                     |

# 10. Nhu cầu màn hình admin và export

| **Màn hình**        | **Chức năng**                                                                                                                    |
|---------------------|----------------------------------------------------------------------------------------------------------------------------------|
| Dashboard           | Tổng đăng ký, tổng abstract, tổng doanh thu dự kiến, số paid/pending/failed/free, số Gala, số theo category/country.             |
| Registration list   | Filter theo scope, language, delegate_category, payment_method, payment_status, date range, gala_dinner, country, keyword.       |
| Registration detail | Thông tin cá nhân, file bằng cấp, phí, payment log, email log, admin note, nút mark paid, resend email, cancel/refund, check-in. |
| Abstract list       | Filter theo category, scope, status, country, submitted date, keyword; tải file hàng loạt.                                       |
| Abstract detail     | Thông tin người nộp, CV, headshot, abstract file, degree, review note, status update, send result email.                         |
| Export Excel/CSV    | Tối thiểu: danh sách đăng ký, danh sách thanh toán, danh sách abstract, danh sách gala, danh sách ăn kiêng, danh sách check-in.  |
| Settings            | Cấu hình deadline, phí, bank info, email templates, bật/tắt form, text thông báo.                                                |

# 11. Acceptance criteria cho dev/test

- Submit form thiếu field bắt buộc phải báo lỗi đúng ngôn ngữ và không tạo hồ sơ rác.

- Server tự tính lại phí, không tin total_amount gửi từ frontend.

- Trước 15/09/2026 hệ thống tính early fee; từ 16/09/2026 tính standard/on-site fee theo ngày thanh toán thực tế.

- Chọn online payment phải cộng 6% transaction fee và redirect sang payment gateway.

- Callback online success cập nhật payment_success/confirmed và gửi email tương ứng.

- Callback failed/cancel cập nhật trạng thái và hiển thị đúng trang phản hồi.

- Bank transfer submit phải tạo registration_id, hiển thị bank info và gửi email hướng dẫn.

- Nhóm miễn phí có thể hoàn tất mà không cần payment, trừ khi chọn Gala và rule yêu cầu thu phí Gala.

- Abstract form khóa sau 01/09/2026 23:59 GMT+7 hoặc hiển thị thông báo theo cấu hình.

- Admin có thể export Excel đầy đủ field và tải file upload.

- Email template hiển thị đúng biến: title + full_name, event, date, venue, registration_id/submission_id, total amount, payment method.

- Registration ID/submission ID phải unique, dễ đọc, ví dụ SIRHCM26-R0001 và SIRHCM26-A0001.

# 12. Điểm cần xác nhận với BTC trước khi build

| **Vấn đề**                    | **Dữ liệu hiện tại**                                                                                                                  | **Đề xuất xử lý**                                                                                                  |
|-------------------------------|---------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------|
| Ngày áp dụng form tiêu chuẩn  | Trong phần VN có dòng “từ ngày 16/9/2025” và comment “Đổi thành form này từ ngày 21/3/2025”, trong khi phần tổng quan ghi 16/09/2026. | Chốt lại date logic: trước 15/09/2026 là early; từ 16/09/2026 là standard/on-site.                                 |
| Plenary/Invited Speakers      | Phần phản hồi/email có nhánh Plenary/Invited Speakers miễn phí toàn bộ, nhưng bảng phí lại ghi SIRHCM Member, Oral, Poster miễn phí.  | Bổ sung option Plenary/Invited Speakers trong delegate_category hoặc map vào fee_waived_category.                  |
| Mã nội dung chuyển khoản      | Tài liệu overview ghi “Họ tên + SĐT”; phần sau submit/email ghi “Họ tên - Mã đăng ký”.                                                | Nên dùng “Họ tên - Mã đăng ký \| Đóng phí SIRHCM2026” vì mã đăng ký chỉ có sau submit và dễ đối soát.              |
| Abstract EN thiếu email       | Form Abstract EN không thấy trường Email, nhưng màn hình phản hồi nói sẽ gửi email xác nhận.                                          | Bắt buộc bổ sung email vào Abstract EN.                                                                            |
| Headshot Abstract EN          | EN không đánh dấu \* cho HEADSHOT, VN đánh dấu bắt buộc.                                                                              | Chốt required hay optional. Khuyến nghị required cho đồng bộ.                                                      |
| Validate 500-1000 từ abstract | Tài liệu quy định số từ nhưng form chỉ yêu cầu upload file.                                                                           | Nếu cần validate tự động, thêm textarea hoặc parser file docx/pdf; nếu không thì admin/reviewer kiểm tra thủ công. |
| Online fee 6%                 | Chưa ghi rõ 6% tính trên phí tham dự hay tổng gồm Gala.                                                                               | Đề xuất tính trên subtotal = phí tham dự + Gala, làm tròn tới VNĐ.                                                 |
| Biên lai/thư mời              | Tài liệu ghi e-receipt và invitation gửi cùng email xác nhận sau thanh toán.                                                          | Cần module generate PDF/e-receipt hoặc tối thiểu email attachment/manual upload.                                   |

## 12.1 Các cấu hình nên chốt thêm

- Dung lượng tối đa cho từng file upload và tổng hồ sơ.

- Định dạng file hợp lệ cho CV, abstract, headshot, degree.

- Có yêu cầu xuất invoice/e-receipt PDF tự động hay admin gửi thủ công.

- Có yêu cầu cổng OnePay/VNPAY/Stripe/local gateway nào không.

- Có cần tạo QR code trên email/badge để check-in nhanh không.

- Có cần song ngữ trên cùng một email hay tách theo locale của form.

- Có cần workflow reviewer nhiều vòng cho abstract không.

- Có cần chức năng người dùng tự sửa hồ sơ sau khi submit không.

# 13. Checklist triển khai nhanh

| **Nhóm việc** | **Checklist**                                                                                                              |
|---------------|----------------------------------------------------------------------------------------------------------------------------|
| Frontend      | 4 form variant, fee calculator, upload component, deadline notice, captcha, success/cancel/failed pages.                   |
| Backend       | Validation, registration_id/submission_id generator, fee engine, file storage, payment integration, email queue.           |
| Admin         | CRUD/filter/export, payment reconciliation, status update, email resend, file download, check-in.                          |
| Email         | SMTP config, bilingual templates, variables, email log, retry failed email.                                                |
| Security      | File type validation, private storage, signed download URL, rate limit, captcha, audit log.                                |
| QA            | Test fee periods, fee waiver, Gala, online success/failed/cancel, bank transfer, missing required file, abstract deadline. |

---

## Machine-readable implementation hints

```yaml
modules:
  registration:
    variants: [domestic_vi, international_en]
    id_prefix: SIRHCM26-R
    payment_required_when: total_amount > 0
    payment_methods: [online_payment, bank_transfer]
    currency: VND
  abstract_submission:
    variants: [domestic_vi, international_en]
    id_prefix: SIRHCM26-A
    deadline: "2026-09-01T23:59:00+07:00"
    review_statuses: [submitted, under_review, accepted, rejected, withdrawn, revision_requested]
fee_rules:
  early_deadline: "2026-09-15"
  standard_start: "2026-09-16"
  online_transaction_fee_percent: 6
  gala_dinner_fee: 800000
  categories:
    physician:
      early: 1000000
      standard: 2000000
    allied_health:
      early: 800000
      standard: 1200000
    sirhcm_member:
      early: 0
      standard: 0
    oral_presentation:
      early: 0
      standard: 0
    poster_presentation:
      early: 0
      standard: 0
open_questions:
  - Confirm Plenary/Invited Speakers category mapping and fee waiver rule.
  - Confirm whether fee waiver categories still pay Gala Dinner fee.
  - Confirm Abstract EN requires email and headshot.
  - Confirm accepted file types and max upload size.
  - Confirm payment gateway provider and rounding rule for 6% fee.
```
