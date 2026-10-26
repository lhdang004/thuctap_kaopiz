# SPEC.md — Tính năng đặt hàng nông sản

## 1. Tổng quan

**Tên tính năng:** Đặt hàng nông sản (Place Order)

**Mục tiêu:** Cho phép khách hàng đặt mua nông sản từ danh sách sản phẩm, nhập thông tin giao hàng, chọn phương thức thanh toán và nhận thông tin đơn hàng.

**Đối tượng sử dụng:**

- Guest: Chưa được hỗ trợ trong phiên bản đầu; phải đăng nhập để đặt hàng.
- Customer: Khách hàng đã đăng nhập.
- Admin: Quản trị viên quản lý đơn hàng, không được sử dụng API đặt hàng thay cho khách hàng.

**Giả định hệ thống:**

- Backend sử dụng Laravel và MySQL.
- Đơn hàng được tạo từ danh sách sản phẩm khách hàng gửi lên; server không dựa vào giá hoặc tổng tiền do client gửi.
- Hệ thống hỗ trợ thanh toán khi nhận hàng (COD).
- Giá sản phẩm và tồn kho được quản lý ở phía server.
- Chỉ hỗ trợ giao hàng tới địa chỉ thuộc khu vực đang được cấu hình phục vụ.

## 2. API Endpoint

### 2.1. Tạo đơn hàng

- **Method:** `POST`
- **Endpoint:** `/api/v1/orders`
- **Authentication:** Bearer token hợp lệ.
- **Content-Type:** `application/json`

Chỉ cho phép customer tạo đơn hàng của chính mình, xác định từ thông tin xác thực phía server. Guest checkout không thuộc phạm vi phiên bản này.

### 2.2. Xem chi tiết đơn hàng

- **Method:** `GET`
- **Endpoint:** `/api/v1/orders/{orderId}`
- **Authentication:** Bearer token hợp lệ.
- **Authorization:** Chỉ chủ sở hữu đơn hàng hoặc admin có quyền phù hợp mới được xem.

### 2.3. Hủy đơn hàng

- **Method:** `POST`
- **Endpoint:** `/api/v1/orders/{orderId}/cancel`
- **Authentication:** Bearer token hợp lệ.
- **Authorization:** Customer chỉ được hủy đơn của mình khi đơn còn `pending`. Admin có quyền quản lý đơn hàng có thể hủy đơn `pending` hoặc `confirmed`, nhưng không được hủy đơn đã `shipped` hoặc `completed`.
- **Request body:** Không bắt buộc; nếu có, chỉ nhận `reason` dạng chuỗi, tối đa 500 ký tự.

Hủy đơn và hoàn lại tồn kho phải thực hiện nguyên tử. COD không phát sinh hoàn tiền. Nếu bổ sung phương thức trả trước trong tương lai, quy trình hoàn tiền phải được đặc tả riêng.

### 2.4. Danh sách API và mã phản hồi

| HTTP Status                 | Ý nghĩa                                 |
| --------------------------- | --------------------------------------- |
| `201 Created`               | Tạo đơn hàng thành công                 |
| `200 OK`                    | Lấy thông tin đơn hàng thành công       |
| `200 OK`                    | Hủy đơn hàng thành công                 |
| `400 Bad Request`           | Request sai định dạng hoặc không hợp lệ |
| `401 Unauthorized`          | Chưa đăng nhập hoặc token không hợp lệ  |
| `403 Forbidden`             | Không có quyền thực hiện                |
| `404 Not Found`             | Không tìm thấy tài nguyên               |
| `409 Conflict`              | Xung đột tồn kho hoặc yêu cầu trùng lặp |
| `422 Unprocessable Entity`  | Dữ liệu đầu vào không đạt validation    |
| `429 Too Many Requests`     | Vượt giới hạn số request                |
| `500 Internal Server Error` | Lỗi hệ thống                            |

Với API tạo đơn hàng, sản phẩm không tồn tại hoặc không thể đặt được trả `422` tại trường `items`; `404` dành cho tài nguyên đơn hàng không tồn tại hoặc không được phép tiết lộ. Request có trường ngoài whitelist trả `422`, không âm thầm bỏ qua.

## 3. Request / Response

### 3.1. Request tạo đơn hàng

`POST /api/v1/orders`

Payload mẫu: `create_order_request` trong [data.json](./data.json).

**Quy tắc dữ liệu đầu vào:**

- `items`: Bắt buộc, từ 1 đến 50 dòng hàng; mỗi `product_id` chỉ được xuất hiện một lần.
- `product_id`: Bắt buộc, ID sản phẩm tồn tại.
- `quantity`: Số nguyên từ 1 đến 100 cho mỗi sản phẩm.
- Tổng số lượng của toàn đơn không vượt quá 500.
- `recipient_name`: Bắt buộc, tối đa 100 ký tự.
- `phone`: Bắt buộc, đúng định dạng số điện thoại được hỗ trợ.
- `province`, `district`, `ward`: Bắt buộc; phải khớp với địa giới và khu vực giao hàng đang được hệ thống hỗ trợ.
- `address_detail`: Bắt buộc, tối đa 255 ký tự.
- `payment_method`: Bắt buộc và hiện chỉ chấp nhận `cod`.
- `note`: Không bắt buộc, tối đa 500 ký tự.

Không nhận các trường do client tự quyết định như `user_id`, `unit_price`, `total_price`, `discount_amount` hoặc `order_status`.
Tổng tiền phải nằm trong giới hạn an toàn của kiểu dữ liệu lưu trữ và giới hạn đơn hàng `MAX_ORDER_TOTAL_VND`. Giá trị này bắt buộc phải được cấu hình trước khi triển khai; nếu thiếu cấu hình hoặc đơn vượt giới hạn, từ chối tạo đơn, không làm tròn hoặc tràn số.

### 3.2. Response thành công

HTTP `201 Created`

Response mẫu: `create_order_response_201` trong [data.json](./data.json).

Lưu ý: Giá và số liệu trong ví dụ chỉ để minh họa. Backend phải tính lại toàn bộ số tiền từ dữ liệu đáng tin cậy trong cơ sở dữ liệu.
Giá được xác nhận từ dữ liệu server trong transaction tạo đơn; nếu giá thay đổi so với lúc khách xem sản phẩm, đơn được tính theo giá tại thời điểm này và response phải trả đúng giá đã lưu trong snapshot.

### 3.3. Response xem chi tiết đơn hàng

HTTP `200 OK`

Response mẫu: `get_order_response_200` trong [data.json](./data.json).

Chi tiết đơn hàng trả snapshot đã lưu, kể cả khi sản phẩm hiện tại đã đổi tên hoặc bị xóa. Không trả dữ liệu cá nhân của chủ đơn cho người không có quyền.

### 3.4. Response hủy đơn thành công

HTTP `200 OK`

Response mẫu: `cancel_order_response_200` trong [data.json](./data.json).

### 3.5. Response lỗi validation

HTTP `422 Unprocessable Entity`

Response mẫu: `validation_error_response_422` trong [data.json](./data.json).

### 3.6. Response lỗi tồn kho

HTTP `409 Conflict`

Response mẫu: `stock_conflict_response_409` trong [data.json](./data.json).

### 3.7. Response lỗi xác thực

HTTP `401 Unauthorized`

Response mẫu: `unauthenticated_response_401` trong [data.json](./data.json).

Không trả về token, thông tin nội bộ hoặc stack trace trong response lỗi.

### 3.8. Response lỗi idempotency

HTTP `409 Conflict` khi cùng `Idempotency-Key` đang được xử lý hoặc được dùng lại với payload khác.

Response mẫu: `idempotency_in_progress_response_409` trong [data.json](./data.json).

Nếu payload khác với payload đã lưu, `errors.code` là `idempotency_key_payload_mismatch`. Client chỉ retry request đang xử lý bằng cùng key và cùng payload.

## 4. Business Rules

### BR-01: Xác thực người dùng

- API yêu cầu Bearer token hợp lệ; chỉ customer đã đăng nhập được tạo đơn. Guest checkout chưa được hỗ trợ và request chưa xác thực trả `401`.
- Xác định người đặt hàng từ thông tin xác thực phía server.
- Không tin tưởng `user_id` gửi từ client.

### BR-02: Kiểm tra sản phẩm

- Tất cả sản phẩm phải tồn tại.
- Sản phẩm phải đang hoạt động và được phép bán.
- Không cho phép đặt sản phẩm đã bị xóa, ngừng kinh doanh hoặc chưa được mở bán.
- Không cho phép số lượng bằng 0, số âm hoặc số thập phân.
- Mỗi `product_id` chỉ được xuất hiện một lần trong `items`; dòng trùng trả `422`, không tự gộp.
- Tối đa 50 dòng hàng và tổng số lượng tối đa 500 cho một đơn.

### BR-03: Kiểm tra tồn kho

- Tồn kho phải đủ cho toàn bộ số lượng đặt.
- Kiểm tra và trừ tồn kho trong transaction.
- Sử dụng khóa bản ghi hoặc câu lệnh cập nhật có điều kiện để tránh bán vượt tồn kho khi nhiều khách đặt đồng thời.
- Nếu bất kỳ sản phẩm nào không đủ hàng, rollback toàn bộ transaction.

### BR-04: Tính giá

- Đơn giá phải lấy từ cơ sở dữ liệu phía server.
- Backend tự tính thành tiền từng dòng: `quantity × unit_price`.
- Backend tự tính tổng tiền hàng, phí vận chuyển, giảm giá và tổng thanh toán.
- Không tin tưởng số tiền hoặc giá do client gửi lên.
- Sử dụng kiểu dữ liệu tiền tệ chính xác, chẳng hạn số nguyên theo đơn vị VND; không dùng số thực dấu phẩy động để tính tiền.
- Phí vận chuyển và điều kiện áp dụng khuyến mãi phải được kiểm tra theo chính sách hiện hành.
- Địa chỉ phải thuộc khu vực phục vụ; các cấp tỉnh/thành, quận/huyện, phường/xã phải là tổ hợp hợp lệ. Ngoài vùng phục vụ hoặc không tính được phí vận chuyển thì trả `422`, không tạo đơn và không mặc định phí bằng 0.
- Giá trong đơn là giá server đọc và xác nhận trong transaction tạo đơn, không phải giá đã hiển thị ở lần tải trang trước.
- Từ chối đơn có tổng tiền vượt giới hạn cấu hình hoặc vượt khả năng lưu trữ/tính toán; không cho phép tràn số.

### BR-05: Tạo đơn hàng nguyên tử

- Tạo bản ghi đơn hàng, các dòng chi tiết và cập nhật tồn kho trong cùng transaction.
- Nếu bất kỳ thao tác bắt buộc nào thất bại, rollback toàn bộ.
- Lưu snapshot tên sản phẩm, đơn giá và các thông tin cần thiết tại thời điểm đặt hàng để giữ lịch sử chính xác.

### BR-06: Trạng thái đơn hàng

- Đơn hàng mới được tạo với trạng thái `pending`.
- Đơn COD mới có `payment_status` là `unpaid`; trạng thái thanh toán không suy ra từ trạng thái đơn hàng.
- Không cho phép client tự truyền trạng thái đơn hàng.
- Khách hàng không được tự chuyển đơn hàng sang trạng thái `confirmed`, `shipped` hoặc `completed`.
- Việc xác nhận, giao hàng và hoàn tất phải thông qua quy trình được phân quyền.
- Customer chỉ được hủy đơn của mình khi trạng thái là `pending`; admin có quyền phù hợp được hủy `pending` hoặc `confirmed`.
- Không được hủy đơn `shipped`, `completed` hoặc đã `cancelled`; trạng thái không hợp lệ trả `409`.
- Chuyển sang `cancelled` và hoàn tồn kho thực hiện trong cùng transaction, tối đa một lần dù có yêu cầu hủy đồng thời.

### BR-07: Thanh toán

- Ban đầu chỉ hỗ trợ COD.
- Đơn hàng COD chưa đồng nghĩa với đã thanh toán.
- Trạng thái thanh toán và trạng thái đơn hàng phải được quản lý riêng.
- Nếu tích hợp cổng thanh toán, chỉ cập nhật thanh toán thành công sau khi xác minh callback/webhook hoặc truy vấn trạng thái đáng tin cậy từ nhà cung cấp.

### BR-08: Chống gửi đơn trùng lặp

- Hỗ trợ `Idempotency-Key` cho request tạo đơn hàng.
- Khóa bắt buộc, độ dài từ 1 đến 255 ký tự; phạm vi duy nhất là customer và endpoint tạo đơn. Lưu khóa tối thiểu 24 giờ.
- So sánh nội dung dựa trên payload đã validate và chuẩn hóa, không phụ thuộc thứ tự key JSON và không bao gồm chính header `Idempotency-Key`.
- Cùng khóa và cùng nội dung phải trả lại HTTP status và response body của lần xử lý đã hoàn tất, không tạo đơn thứ hai.
- Nếu cùng khóa nhưng nội dung khác, trả về `409 Conflict`.
- Nếu request cùng khóa đang được xử lý, trả `409 Conflict` với mã lỗi `idempotency_request_in_progress`; client có thể gửi lại cùng request sau.
- Kết quả thành công hoặc thất bại nghiệp vụ đã hoàn tất được lưu để replay nhất quán trong thời hạn trên; lỗi hệ thống trước khi có kết quả cuối không được ghi nhận như thành công.
- Việc lưu khóa và tạo đơn phải nguyên tử và an toàn khi có request đồng thời; hết thời hạn lưu, client không được dùng lại khóa cũ để retry.

### BR-09: Quyền truy cập

- Khách hàng chỉ được xem đơn hàng thuộc quyền sở hữu của mình.
- Admin chỉ được truy cập theo quyền quản trị được cấp.
- Kiểm tra quyền ở backend, không chỉ ẩn nút trên giao diện.
- Không để việc thay đổi `orderId` cho phép xem đơn hàng của người khác (IDOR).
- Trả `404` cho đơn không tồn tại hoặc không thuộc quyền xem của customer để tránh dò tìm đơn hàng.

### BR-10: Hủy đơn

- API hủy đơn chỉ cho phép customer sở hữu đơn hoặc admin có quyền quản lý đơn tương ứng.
- Nếu đơn đã chuyển sang trạng thái không thể hủy, trả `409` và giữ nguyên trạng thái, tồn kho.
- Hoàn tồn kho và cập nhật trạng thái phải dùng transaction/locking để hai yêu cầu hủy đồng thời không hoàn kho hai lần.
- Vì phiên bản đầu chỉ hỗ trợ COD, hủy đơn không tạo thao tác hoàn tiền.

## 5. Edge Cases

| Trường hợp                                | Xử lý mong đợi                                      |
| ----------------------------------------- | --------------------------------------------------- |
| Danh sách sản phẩm rỗng                   | Trả `422`                                           |
| Sản phẩm không tồn tại                    | Trả `422` tại trường `items.*.product_id`           |
| Sản phẩm ngừng bán                        | Trả `422`, không tạo đơn                            |
| `product_id` xuất hiện nhiều lần          | Trả `422`, không tự gộp dòng                        |
| Số lượng bằng 0 hoặc âm                   | Trả `422`                                           |
| Số lượng vượt giới hạn                    | Trả `422`                                           |
| Quá 50 dòng hàng hoặc tổng lượng quá 500  | Trả `422`                                           |
| Tồn kho không đủ                          | Trả `409`, không tạo đơn                            |
| Hai khách mua sản phẩm cuối cùng cùng lúc | Chỉ cho phép đơn hợp lệ được giữ hàng               |
| Một sản phẩm trong đơn không đủ hàng      | Rollback toàn bộ đơn                                |
| Giá thay đổi trước khi đặt                | Tính theo giá server xác nhận tại thời điểm tạo đơn |
| Client gửi giá giả hoặc trường giá        | Trả `422` với trường ngoài whitelist                |
| Client gửi `user_id` của người khác       | Không sử dụng giá trị đó                            |
| Request bị gửi lại do timeout             | Dùng idempotency để tránh tạo đơn trùng             |
| Token hết hạn hoặc sai                    | Trả `401`                                           |
| Customer xem đơn của người khác           | Trả `404`, không tiết lộ đơn tồn tại hay không      |
| Cơ sở dữ liệu lỗi                         | Rollback, trả lỗi hệ thống phù hợp                  |
| Địa chỉ hoặc số điện thoại sai            | Trả `422`                                           |
| Địa chỉ ngoài vùng giao hàng              | Trả `422`, không tạo đơn                            |
| Phí vận chuyển không tính được            | Từ chối tạo đơn, không tự đặt phí bằng 0            |
| Tổng tiền vượt giới hạn hệ thống          | Từ chối và ghi log an toàn                          |
| Người dùng gửi request quá nhanh          | Áp dụng rate limit                                  |
| Client gửi trường ngoài whitelist         | Trả `422`, không âm thầm bỏ qua                     |
| Sản phẩm bị xóa sau khi đặt               | Giữ thông tin snapshot trong lịch sử đơn hàng       |
| Giá thay đổi đồng thời khi khách đặt      | Dùng giá server xác nhận trong transaction tạo đơn  |
| Thanh toán COD khi tạo đơn                | `payment_status` là `unpaid`                        |
| Customer chưa đăng nhập / guest checkout  | Trả `401`; guest checkout chưa hỗ trợ               |
| Hủy đơn `pending` bởi chủ đơn             | Đổi trạng thái `cancelled`, hoàn tồn kho một lần    |
| Hủy đơn đã `shipped` hoặc `completed`     | Trả `409`, không đổi trạng thái hoặc tồn kho        |
| Hai yêu cầu hủy cùng một đơn đồng thời    | Chỉ hoàn tồn kho một lần                            |
| Gọi GET đơn của người khác                | Trả `404`, không tiết lộ đơn tồn tại hay không      |
| Cùng idempotency key và payload           | Replay kết quả trước, không tạo đơn mới             |
| Cùng key nhưng payload khác               | Trả `409`                                           |
| Cùng key khi request còn xử lý            | Trả `409` với `idempotency_request_in_progress`     |

## 6. Security Requirements

### SEC-01: Authentication và Authorization

- Sử dụng cơ chế xác thực phù hợp, ví dụ Laravel Sanctum.
- Kiểm tra quyền sở hữu đơn hàng trên mọi API đọc hoặc thao tác.
- Không dùng ID khó đoán thay cho kiểm tra quyền; UUID không thay thế authorization.
- Guest checkout không được bật trong phiên bản đầu; không cho phép dùng địa chỉ/điện thoại thay thế authentication.

### SEC-02: Input Validation

- Validate toàn bộ dữ liệu ở server bằng Laravel Form Request hoặc cơ chế tương đương.
- Chỉ chấp nhận các trường được định nghĩa.
- Trường ngoài whitelist trả `422`; giới hạn 50 dòng hàng, 100 sản phẩm mỗi dòng, tổng số lượng 500, chiều dài chuỗi và tổng tiền. `MAX_ORDER_TOTAL_VND` phải được cấu hình trước khi triển khai.
- Chuẩn hóa, xác thực cấu trúc địa chỉ và kiểm tra khu vực giao hàng trước khi tạo đơn.
- Không ghép SQL từ dữ liệu người dùng; sử dụng ORM hoặc parameterized queries.

### SEC-03: Transaction và Concurrency

- Sử dụng database transaction.
- Khóa hoặc cập nhật tồn kho có điều kiện để ngăn overselling.
- Có chiến lược retry giới hạn khi deadlock; không retry vô hạn.
- Bảo đảm tính duy nhất của mã đơn và idempotency key bằng ràng buộc database phù hợp.

### SEC-04: Information Disclosure

- Không trả về password, access token, thông tin nội bộ hoặc dữ liệu khách hàng khác.
- Không đưa SQL, stack trace, đường dẫn server hoặc biến môi trường vào response production.
- Log lỗi không chứa token, thông tin thanh toán nhạy cảm hoặc dữ liệu cá nhân không cần thiết.

### SEC-05: Abuse Prevention

- Rate limit API đặt hàng.
- Giới hạn số sản phẩm và tổng số lượng trong một request.
- Ghi nhận hành vi bất thường mà không lưu dữ liệu nhạy cảm không cần thiết.
- Dùng HTTPS trong môi trường production.

## 7. Acceptance Criteria

1. Khách hàng hợp lệ có thể tạo đơn với dữ liệu hợp lệ.
2. Đơn hàng được tính giá hoàn toàn ở server.
3. Không thể đặt sản phẩm ngừng bán hoặc vượt tồn kho.
4. Nếu tạo đơn thất bại, không để lại dữ liệu đơn hàng hoặc thay đổi tồn kho dở dang.
5. Request gửi lại với cùng idempotency key không tạo đơn thứ hai.
6. Khách hàng không thể xem đơn hàng của người khác.
7. Người dùng không thể tự sửa giá, tổng tiền, chủ sở hữu hoặc trạng thái đơn hàng.
8. API trả đúng mã HTTP và cấu trúc lỗi đã quy định.
9. Các trường hợp lỗi được kiểm thử, bao gồm validation, authorization, tồn kho đồng thời và lỗi database.
10. Chỉ customer đã xác thực được đặt hàng; guest bị từ chối.
11. Dòng sản phẩm trùng, vượt số dòng/tổng số lượng, địa chỉ sai hoặc ngoài vùng phục vụ đều bị từ chối, không tạo đơn.
12. GET đơn trả snapshot và `payment_status`; customer không có quyền nhận `404`.
13. Hủy đơn đúng quyền chỉ thành công ở trạng thái cho phép và hoàn tồn kho đúng một lần dù có request đồng thời.
14. Idempotency được kiểm thử với cùng request, payload khác, request đang xử lý, retry sau lỗi nghiệp vụ và truy cập đồng thời.

## 8. Implementation Notes

- Dùng Laravel Form Request để validate.
- Dùng Service Layer để xử lý nghiệp vụ đặt hàng.
- Dùng Eloquent transaction để bảo đảm tính toàn vẹn dữ liệu.
- Dùng Policy hoặc Gate để kiểm tra quyền truy cập đơn hàng.
- Tách logic tính giá, kiểm tra tồn kho và tạo đơn khỏi Controller.
- Viết Feature Tests cho các luồng thành công, thất bại và phân quyền.
- Không tự ý thay đổi API contract hoặc nghiệp vụ trong SPEC này khi triển khai. Nếu cần thay đổi, cập nhật SPEC trước.

## Loading State

- Khi request tạo đơn đang xử lý, client hiển thị trạng thái loading.
- Vô hiệu hóa nút đặt hàng để hạn chế gửi nhiều request do thao tác liên tục.
- Không hiển thị thông báo thành công trước khi nhận response thành công từ server.
- Nếu timeout, cho phép retry với cùng Idempotency-Key và payload ban đầu.

## Empty State

- Nếu giỏ hàng không có sản phẩm, client hiển thị thông báo giỏ hàng trống.
- Không cho phép gửi request tạo đơn khi giỏ hàng trống.
- Nếu API danh sách đơn hàng trả về danh sách rỗng, client hiển thị
  thông báo chưa có đơn hàng.

  ## Out of Scope

- Guest checkout, đặt hàng không cần đăng nhập.
- Thanh toán trực tuyến qua cổng thanh toán.
- Hoàn tiền và xử lý tranh chấp thanh toán.
- Quản lý danh mục, tạo và chỉnh sửa sản phẩm.
- Quản lý kho độc lập ngoài thao tác kiểm tra và cập nhật tồn kho khi đặt/hủy đơn.
- Tích hợp vận chuyển bên thứ ba và theo dõi hành trình giao hàng.
- Chương trình khuyến mãi nâng cao, tích điểm và đổi điểm.
