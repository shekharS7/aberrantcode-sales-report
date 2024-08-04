<?php
/**
 * Copyright © Shekhar Suman, 2024. All rights reserved.
 * See COPYING.txt for license details.
 * 
 * @package     AberrantCode_SalesReport
 * @version     1.0.0
 * @license     MIT License (http://opensource.org/licenses/MIT)
 * @autor       Shekhar Suman
 */
namespace AberrantCode\SalesReport\Test\Unit\Block\Adminhtml;

use PHPUnit\Framework\TestCase;
use Magento\Backend\Block\Template\Context;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Eav\Api\AttributeRepositoryInterface;
use AberrantCode\SalesReport\Block\Adminhtml\Report;

class ReportTest extends TestCase
{
    protected $contextMock;
    protected $collectionFactoryMock;
    protected $attributeRepositoryMock;
    protected $report;

    protected function setUp(): void
    {
        $this->contextMock = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->collectionFactoryMock = $this->getMockBuilder(CollectionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->attributeRepositoryMock = $this->getMockBuilder(AttributeRepositoryInterface::class)
            ->getMock();

        $this->report = new Report(
            $this->contextMock,
            $this->collectionFactoryMock,
            $this->attributeRepositoryMock
        );
    }

    public function testGetCollection()
    {
        // Mocking CollectionFactory and Collection
        $collectionMock = $this->getMockBuilder(\Magento\Sales\Model\ResourceModel\Order\Collection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($collectionMock);

        $this->assertInstanceOf(\Magento\Sales\Model\ResourceModel\Order\Collection::class, $this->report->getCollection());
    }

    public function testGetAttributeValue()
    {
        // Mocking Attribute and Source
        $attributeMock = $this->getMockBuilder(\Magento\Catalog\Api\Data\ProductAttributeInterface::class)
            ->getMock();

        $sourceMock = $this->getMockBuilder(\Magento\Eav\Model\Entity\Attribute\Source\Table::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributeRepositoryMock->expects($this->once())
            ->method('get')
            ->willReturn($attributeMock);

        $attributeMock->expects($this->once())
            ->method('getSource')
            ->willReturn($sourceMock);

        $sourceMock->expects($this->once())
            ->method('getAllOptions')
            ->willReturn([]);

        $this->assertIsArray($this->report->getAttributeValue());
    }

    public function testGetNextMonth()
    {
        $nextMonth = date('F Y', strtotime("+1 month"));
        $this->assertEquals($nextMonth, $this->report->getNextMonth(1));
    }

    public function testGetProductCount()
    {
        // Mocking Order Collection
        $orderCollectionMock = $this->getMockBuilder(\Magento\Sales\Model\ResourceModel\Order\Collection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($orderCollectionMock);

        // Mocking Order and Item
        $orderMock = $this->getMockBuilder(\Magento\Sales\Model\Order::class)
            ->disableOriginalConstructor()
            ->getMock();

        $itemMock = $this->getMockBuilder(\Magento\Sales\Model\Order\Item::class)
            ->disableOriginalConstructor()
            ->getMock();

        $orderCollectionMock->expects($this->once())
            ->method('addFieldToFilter')
            ->willReturnSelf();

        $orderCollectionMock->expects($this->once())
            ->method('getAllVisibleItems')
            ->willReturn([$itemMock]);

        $itemMock->expects($this->once())
            ->method('getProduct')
            ->willReturnSelf();

        $itemMock->expects($this->once())
            ->method('getProductCategory')
            ->willReturn('test_category');

        $itemMock->expects($this->once())
            ->method('getQtyOrdered')
            ->willReturn(5);

        $this->assertEquals(5, $this->report->getProductCount(1, 'test_category'));
    }

    public function testGetTotal()
    {
        // Mocking Order Collection
        $orderCollectionMock = $this->getMockBuilder(\Magento\Sales\Model\ResourceModel\Order\Collection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($orderCollectionMock);

        // Mocking Order and Item
        $orderMock = $this->getMockBuilder(\Magento\Sales\Model\Order::class)
            ->disableOriginalConstructor()
            ->getMock();

        $itemMock = $this->getMockBuilder(\Magento\Sales\Model\Order\Item::class)
            ->disableOriginalConstructor()
            ->getMock();

        $orderCollectionMock->expects($this->once())
            ->method('addFieldToFilter')
            ->willReturnSelf();

        $orderCollectionMock->expects($this->once())
            ->method('getAllVisibleItems')
            ->willReturn([$itemMock]);

        $itemMock->expects($this->once())
            ->method('getProduct')
            ->willReturnSelf();

        $itemMock->expects($this->once())
            ->method('getProductCategory')
            ->willReturn('test_category');

        $itemMock->expects($this->once())
            ->method('getQtyOrdered')
            ->willReturn(5);

        $this->assertEquals(5, $this->report->getTotal('test_category'));
    }
}
