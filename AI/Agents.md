## Stack

- Node.js 20, Express 4, MySQL 8

## Quy ước

- Dùng const/let, async/await
- Xóa mềm: cột deletedAt
- Phân trang ?page=1&limit=20
- Lỗi trả về { code, message }

# Quy tắc lập trình chung

- Luôn đọc và phân tích code hiện có trước khi sửa.
- Không tự ý viết lại toàn bộ dự án.
- Không tự ý xóa chức năng đang hoạt động.
- Tuân thủ nguyên tắc bảo mật và validate dữ liệu đầu vào.
- Khi sửa code, phải giải thích những file đã sửa và lý do.
- Viết test cho chức năng mới và kiểm tra lỗi sau khi sửa.
- Nếu yêu cầu chưa rõ, hỏi lại trước khi triển khai.
- Ưu tiên giải pháp đơn giản, dễ hiểu cho người mới học lập trình.
- Không tự ý thay đổi nghiệp vụ đã được quy định trong SPEC.md.
- Báo cáo rõ những việc đã hoàn thành và những việc chưa kiểm thử.

## KHÔNG làm

- Không hardcode mật khẩu, API key
- Không trả password trong response
- Không truy vấn DB trong vòng lặp
