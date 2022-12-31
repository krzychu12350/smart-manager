import api from "./api";

class PdfReportService {
  async getSalaryReport(data) {
    return api.get("/pdf/salary", data);
  }
}

export default new PdfReportService();
