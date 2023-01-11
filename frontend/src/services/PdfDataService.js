import api from "./api";

const addictionalHeader =  {
  responseType: "blob",
};

class PdfReportService {
  async getSalaryReport(data) {
    return api.post("/pdf/salary", data, addictionalHeader);
  }

  async getEmployeeEvaluationPDF(data) {
    return api.post("/pdf/employee-evaluation", data, addictionalHeader);
  }
}

export default new PdfReportService();
