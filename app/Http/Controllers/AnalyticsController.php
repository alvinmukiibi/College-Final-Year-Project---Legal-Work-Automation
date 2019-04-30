<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use LaravelDaily\LaravelCharts\Classes\LaravelChart;
// use App\Charts\ChartOne;
use Lava;
use App\LegalCase;
use App\User;
use App\Firm;
use App\Department;
use App\CaseType;
class AnalyticsController extends Controller
{
    public function viewReports(Request $request){

    /*    $chart1 = new ChartOne;
        $chart1->labels(['alvin', 'kelly', 'mukiibi']);
        $dataset = $chart1->dataset("Bad Boy Scalez", 'bar', [8, 2, 5]);
        $dataset->color('#0679fb');
        $dataset->fill(true);
    */
        $this->lineGraphForLearning();
        $this->pieChartForDepartmentToCases();
        $this->LineChartForCaseTypesToCases();

        return view('firm.partner.reports');
    }

    public function getTotalCasesInDept(){
        // this function retrieves the number of all cases that were intaken to all users in a certain department
        $dept = $this->dept;
        $users = User::where(['department' => $dept->id])->select('users.id')->get();
        $sum = 0;
        foreach($users as $user){
            $numberOfCasesIntaken = LegalCase::where(['staff' => $user->id])->count();
            $sum += $numberOfCasesIntaken;
        }
        return $sum;
    }
    public function getTotalCasesInCaseType(){
        $caseType = $this->caseType;
        $numberOfCases = LegalCase::where(['case_type' => $caseType->id])->count();
        return $numberOfCases;

    }

    public function LineChartForCaseTypesToCases(){
        $firm_id = auth()->user()->firm_id;
        $firm = new Firm;
        $firm->id = $firm_id;
        $caseTypes = CaseType::where(['firm_id' => $firm_id])->get();

        $testData = Lava::DataTable();
        $testData->addStringColumn("Case Types")->addNumberColumn('Total Number of Cases');

        foreach($caseTypes as $caseType){
            $this->caseType = $caseType;
            $testData->addRow([$caseType->casetype, $this->getTotalCasesInCaseType()]);
        }

        $options = [
            'title' => 'Case Types and Total Number of Cases',
        ];

        $chart2 = Lava::BarChart('LineChartCaseTypesCases', $testData, $options);
    }

    public function pieChartForDepartmentToCases(){

        $firm_id = auth()->user()->firm_id;
        $firm = new Firm;
        $firm->id = $firm_id;
        $depts = Department::where(['firm_id' => $firm_id])->get();

        $testData = Lava::DataTable();
        $testData->addStringColumn("Departments")->addNumberColumn('Total Number of Cases');

        foreach($depts as $dept){
            $this->dept = $dept;
            $testData->addRow([$dept->name, $this->getTotalCasesInDept()]);
        }

        $options = [
            'title' => 'Departments and Total Number of Cases',
            'is3D' => true,
            'pieSliceBorderColor' => '#0679fb'
        ];

        $chart2 = Lava::PieChart('PieChartDepartmentsCases', $testData, $options);

    }
    public function lineGraphForLearning(){
        $stocksTable = Lava::DataTable();
        $stocksTable->addDateColumn('Day of Month')->addNumberColumn('Projected')->addNumberColumn('Official');

        for ($a = 1; $a < 5; $a++) {
            $stocksTable->addRow([
              '2015-10-' . $a, rand(800,1000), rand(800,1000)
            ]);
        }
        $chart = Lava::LineChart('MyStocks', $stocksTable, ['title' => 'Github stock price']);
    }
}
