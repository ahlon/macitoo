<html xmlns:ng="http://angularjs.org" ng-app>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
</head>
<body>
    <div ng-controller="InvoiceCntl">
        <b>Invoice:</b> <br> <br>
        <table>
            <tr>
                <td>Quantity</td>
                <td>Cost</td>
            </tr>
            <tr>
                <td><input type="number" ng-pattern="/\d+/" step="1" min="0" ng-model="qty" required></td>
                <td><input type="number" ng-model="cost" required></td>
            </tr>
        </table>
        <hr>
        <b>Total:</b> {{qty * cost | currency}}
    </div>

    <div ng-controller="InvoiceCntl">
        <b>Invoice:</b> <br> <br>
        <table>
            <tr>
                <td>Quantity</td>
                <td>Cost</td>
            </tr>
            <tr>
                <td><input type="number" ng-pattern="/\d+/" step="1" min="0" ng-model="qty" required></td>
                <td><input type="number" ng-model="cost" required></td>
            </tr>
        </table>
        <hr>
        <b>Total:</b> {{qty * cost | currency}}
    </div>

    <div ng-controller="AlbumCtrl">
        <ul>
            <li ng-repeat="image in images"><img ng-src="{{image.thumbnail}}" alt="{{image.description}}"></li>
        </ul>
    </div>

    <div ng-controller="ActivitiesListCtrl">
        <h1>Today's activities</h1>
        <ul>
            <li ng-repeat="activity in activities">{{activity.name}}</li>
        </ul>
    </div>
    
    <div contentEditable="true" ng-model="content">Edit Me</div>
    <pre>model = {{content}}</pre>
</body>
</html>

<script>
function InvoiceCntl($scope) {
  $scope.qty = 1;
  $scope.cost = 19.95;
}
	
function AlbumCtrl($scope) {
	$scope.images = [
        {"image":"img/image_01.png", "description":"Image 01 description"},
        {"image":"img/image_02.png", "description":"Image 02 description"},
        {"image":"img/image_03.png", "description":"Image 03 description"},
        {"image":"img/image_04.png", "description":"Image 04 description"},
        {"image":"img/image_05.png", "description":"Image 05 description"}
    ];
}

function ActivitiesListCtrl($scope) {
  $scope.activities = [
    { "name": "Wake up" },
    { "name": "Brush teeth" },
    { "name": "Shower" },
    { "name": "Have breakfast" },
    { "name": "Go to work" },
    { "name": "Write a Nettuts article" },
    { "name": "Go to the gym" },
    { "name": "Meet friends" },
    { "name": "Go to bed" }
  ];
 }
</script>