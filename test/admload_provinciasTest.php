<?php
use PHPUnit\Framework\TestCase;

class LoadProvinciasTest extends TestCase
{
    public function testLoadProvincias()
    {
        // Mock the Database class
        $databaseMock = $this->getMockBuilder(Database::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock the PDO class
        $pdoMock = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock the PDOStatement class
        $stmtMock = $this->getMockBuilder(PDOStatement::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Set up the expected method calls and return values
        $databaseMock->expects($this->once())
            ->method('getConnection')
            ->willReturn($pdoMock);

        $pdoMock->expects($this->once())
            ->method('query')
            ->with('SELECT id, provincia FROM provincias')
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('fetchAll')
            ->with(PDO::FETCH_ASSOC)
            ->willReturn([
                ['id' => 1, 'provincia' => 'Provincia 1'],
                ['id' => 2, 'provincia' => 'Provincia 2'],
                ['id' => 3, 'provincia' => 'Provincia 3'],
            ]);

        // Instantiate the class under test
        $loadProvincias = new LoadProvincias($databaseMock);

        // Call the method under test
        $result = $loadProvincias->loadProvincias();

        // Assert the expected result
        $expectedResult = [
            ['id' => 1, 'provincia' => 'Provincia 1'],
            ['id' => 2, 'provincia' => 'Provincia 2'],
            ['id' => 3, 'provincia' => 'Provincia 3'],
        ];
        $this->assertEquals($expectedResult, $result);
    }
}
?>