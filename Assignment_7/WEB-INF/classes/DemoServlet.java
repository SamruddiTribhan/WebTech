import jakarta.servlet.http.*;  
import jakarta.servlet.*;  
import java.io.*; 
import java.sql.*;  

public class DemoServlet extends HttpServlet {

    public void doGet(HttpServletRequest req, HttpServletResponse res) throws ServletException, IOException {
        res.setContentType("text/html");
        PrintWriter pw = res.getWriter();

        pw.println("<html><head><style>");
        pw.println("body { font-family: Arial; margin: 40px; background: #f9f9f9; }");
        pw.println("table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }");
        pw.println("th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }");
        pw.println("th { background-color: #4CAF50; color: white; }");
        pw.println("form { margin-bottom: 30px; background: #fff; padding: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }");
        pw.println("input[type=text], input[type=number] { width: 100%; padding: 8px; margin: 5px 0; }");
        pw.println("input[type=submit] { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }");
        pw.println("</style></head><body>");

        pw.println("<h2>Welcome to Pragati eBookShop</h2>");

        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/pragati", "root", "");
            Statement stmt = con.createStatement();

            ResultSet rs = stmt.executeQuery("SELECT * FROM ebookshop");
            pw.println("<table>");
            pw.println("<tr><th>Book ID</th><th>Title</th><th>Author</th><th>Price</th><th>Quantity</th></tr>");
            while (rs.next()) {
                pw.println("<tr>");
                pw.println("<td>" + rs.getInt("b_id") + "</td>");
                pw.println("<td>" + rs.getString("b_title") + "</td>");
                pw.println("<td>" + rs.getString("b_author") + "</td>");
                pw.println("<td>" + rs.getDouble("b_price") + "</td>");
                pw.println("<td>" + rs.getInt("quantity") + "</td>");
                pw.println("</tr>");
            }
            pw.println("</table>");
            con.close();
        } catch (Exception e) {
            pw.println("<p style='color:red;'>Error: " + e + "</p>");
        }

        // Add Book Form
        pw.println("<h3>Add New Book</h3>");
        pw.println("<form method='post'>");
        pw.println("<input type='hidden' name='action' value='add'/>");
        pw.println("Book ID: <input type='number' name='b_id' required/><br/>");
        pw.println("Title: <input type='text' name='b_title' required/><br/>");
        pw.println("Author: <input type='text' name='b_author' required/><br/>");
        pw.println("Price: <input type='text' name='b_price' required/><br/>");
        pw.println("Quantity: <input type='text' name='quantity' required/><br/>");
        pw.println("<input type='submit' value='Add Book'/>");
        pw.println("</form>");

        // Update Form
        pw.println("<h3>Update Book</h3>");
        pw.println("<form method='post'>");
        pw.println("<input type='hidden' name='action' value='update'/>");
        pw.println("Book ID: <input type='number' name='b_id' required/><br/>");
        pw.println("New Title: <input type='text' name='b_title' required/><br/>");
        pw.println("New Author: <input type='text' name='b_author' required/><br/>");
        pw.println("New Price: <input type='text' name='b_price' required/><br/>");
        pw.println("New Quantity: <input type='text' name='quantity' required/><br/>");
        pw.println("<input type='submit' value='Update Book'/>");
        pw.println("</form>");

        // Delete Form
        pw.println("<h3>Delete Book</h3>");
        pw.println("<form method='post'>");
        pw.println("<input type='hidden' name='action' value='delete'/>");
        pw.println("Book ID to Delete: <input type='number' name='b_id' required/><br/>");
        pw.println("<input type='submit' value='Delete Book'/>");
        pw.println("</form>");

        pw.println("</body></html>");
        pw.close();
    }
    public void doPost(HttpServletRequest req, HttpServletResponse res) throws ServletException, IOException {
        res.setContentType("text/html");
        PrintWriter pw = res.getWriter();
        String action = req.getParameter("action");
    
        try {
            Class.forName("com.mysql.jdbc.Driver");
            Connection con = DriverManager.getConnection("jdbc:mysql://localhost:3306/pragati", "root", "");
    
            if ("add".equalsIgnoreCase(action)) {
                String b_id = req.getParameter("b_id");
                String b_title = req.getParameter("b_title");
                String b_author = req.getParameter("b_author");
                String b_price = req.getParameter("b_price");
                String quantity = req.getParameter("quantity");
    
                String query = "INSERT INTO ebookshop (b_id, b_title, b_author, b_price, quantity) VALUES (?, ?, ?, ?, ?)";
                PreparedStatement ps = con.prepareStatement(query);
                ps.setInt(1, Integer.parseInt(b_id));
                ps.setString(2, b_title);
                ps.setString(3, b_author);
                ps.setDouble(4, Double.parseDouble(b_price));
                ps.setInt(5, Integer.parseInt(quantity));
                ps.executeUpdate();
                pw.println("<p style='color:green;'>Book added successfully.</p>");
            }
    
            if ("update".equalsIgnoreCase(action)) {
                String b_id = req.getParameter("b_id");
    
                // Check if b_id exists
                PreparedStatement checkStmt = con.prepareStatement("SELECT * FROM ebookshop WHERE b_id=?");
                checkStmt.setInt(1, Integer.parseInt(b_id));
                ResultSet rs = checkStmt.executeQuery();
    
                if (rs.next()) {
                    String b_title = req.getParameter("b_title");
                    String b_author = req.getParameter("b_author");
                    String b_price = req.getParameter("b_price");
                    String quantity = req.getParameter("quantity");
    
                    String query = "UPDATE ebookshop SET b_title=?, b_author=?, b_price=?, quantity=? WHERE b_id=?";
                    PreparedStatement ps = con.prepareStatement(query);
                    ps.setString(1, b_title);
                    ps.setString(2, b_author);
                    ps.setDouble(3, Double.parseDouble(b_price));
                    ps.setInt(4, Integer.parseInt(quantity));
                    ps.setInt(5, Integer.parseInt(b_id));
                    ps.executeUpdate();
                    pw.println("<p style='color:green;'>Book updated successfully.</p>");
                } else {
                    pw.println("<p style='color:red;'>Error: Book ID " + b_id + " not found. Cannot update.</p>");
                }
            }
    
            if ("delete".equalsIgnoreCase(action)) {
                String b_id = req.getParameter("b_id");
    
                // Check if b_id exists
                PreparedStatement checkStmt = con.prepareStatement("SELECT * FROM ebookshop WHERE b_id=?");
                checkStmt.setInt(1, Integer.parseInt(b_id));
                ResultSet rs = checkStmt.executeQuery();
    
                if (rs.next()) {
                    String query = "DELETE FROM ebookshop WHERE b_id=?";
                    PreparedStatement ps = con.prepareStatement(query);
                    ps.setInt(1, Integer.parseInt(b_id));
                    ps.executeUpdate();
                    pw.println("<p style='color:red;'>Book deleted successfully.</p>");
                } else {
                    pw.println("<p style='color:red;'>Error: Book ID " + b_id + " not found. Cannot delete.</p>");
                }
            }
    
            con.close();
        } catch (Exception e) {
            pw.println("<p style='color:red;'>Error: " + e + "</p>");
        }
    
        res.setHeader("Refresh", "2; URL=" + req.getRequestURI());
        pw.close();
    }
    
}
