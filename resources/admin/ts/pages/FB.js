'use strict';

// Bài Hướng dẫn setup FB:
// https://developers.facebook.com/apps/629175208783346/fb-login/quickstart/

// 1. Cho chúng tôi biết về trang web của bạn
  // Cho chúng tôi biết URL của trang web của bạn là gì.

// 2. Thiết lập SDK Facebook dành cho JavaScript
  // Facebook SDK dành cho JavaScript không có bất kỳ tệp độc lập nào cần tải xuống hay cài đặt,
  // thay vào đó, bạn chỉ cần đưa một đoạn ngắn của JavaScript thông thường vào HTML sẽ tải
  // không đồng bộ SDK vào các trang của bạn.Tải không đồng bộ nghĩa là không chặn tải các phần tử khác của trang.

// 3. Kiểm tra trạng thái đăng nhập
  // status chỉ định trạng thái đăng nhập của người dùng ứng dụng. Trạng thái có thể là:
  // connected - người đó đã đăng nhập Facebook và đăng nhập ứng dụng của bạn.
  // not_authorized - người đó đã đăng nhập Facebook nhưng không đăng nhập ứng dụng của bạn.
  // unknown - người đó không đăng nhập Facebook nên bạn không biết họ có đăng nhập ứng dụng
  // của mình không hoặc FB.logout() đã được gọi trước đó và do vậy, không thể kết nối với Facebook.

  // Có authResponse nếu trạng thái là connected và bao gồm các yếu tố sau:
  // accessToken - bao gồm một mã truy cập cho người dùng ứng dụng.
  // expiresIn - cho biết thời gian UNIX khi mã hết hạn và cần được gia hạn.
  // signedRequest - một thông số được đánh dấu bao gồm thông tin về người dùng ứng dụng.
  // userID - ID của người dùng ứng dụng.

  // Sau khi ứng dụng biết trạng thái đăng nhập của người dùng, ứng dụng đó có thể thực hiện một trong những điều sau:
  // Nếu người đó đăng nhập vào Facebook và ứng dụng của bạn, hãy chuyển họ đến trải nghiệm đăng nhập của ứng dụng.
  // Nếu người đó không đăng nhập ứng dụng của bạn hoặc không đăng nhập Facebook, hãy nhắc họ bằng hộp thoại
  // Đăng nhập bằng FB.login() hoặc hiển thị cho họ nút Đăng nhập.
  
// 4. Thêm nút Đăng nhập Facebook
  // Việc thêm nút Đăng nhập vào trang rất đơn giản. Hãy truy cập tài liệu về nút đăng nhập và thiết lập nút theo 
  // cách bạn muốn.Sau đó nhấp vào Nhận mã và bạn sẽ nhìn thấy mã mình cần để hiển thị nút này trên trang.
  // Thuộc tính onlogin trên nút để thiết lập lệnh gọi lại JavaScript kiểm tra trạng thái đăng nhập để xem người 
  // đó đã đăng nhập thành công chưa:
  // <fb:login-button
  //   scope="public_profile,email"
  //   onlogin="checkLoginState();">
  // </fb:login-button>Sao chép mã
  // Đây là lệnh gọi lại. Lệnh này gọi FB.getLoginStatus() để nhận trạng thái đăng nhập gần đây nhất. 
  // (statusChangeCallback() là hàm thuộc một phần của ví dụ xử lý phản hồi.)
  // function checkLoginState() {
  //   FB.getLoginStatus(function(response) {
  //     statusChangeCallback(response);
  //   });
  // }
  
function fn() {
  const statusChangeCallback = ({ status, authResponse }) => {
    if (status === "not_authorized") {// not_authorized | unknown
      console.log('You are not logged in', authResponse);
    } else {//connected => FB.logout()
      console.log('You are logged in', authResponse);
    }
  }

  if (FB && typeof FB.getLoginStatus === 'function') {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
}

window.startWorkingWithFBAPI = fn;
