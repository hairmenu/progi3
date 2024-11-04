// tests/HelloWorld.spec.js
import { mount } from '@vue/test-utils'
import { describe, it, expect, vi } from 'vitest';
import CalculatePriceRow from '../../src/components/CalculatePriceRow.vue'

describe('CalculatePriceRow.vue', () => {
  it('renders a row with its id', () => {
    const wrapper = mount(CalculatePriceRow, {
      props: { row_number: 8654 },
    })
    expect(wrapper.text()).toContain('8654') 
  })

  it('verifies select exists and has 0, L and C options', () => {
    const wrapper = mount(CalculatePriceRow, {
      props: { row_number: 1 }
    });

    // Find the select element
    const select = wrapper.find('select');
    expect(select.exists()).toBe(true);

    // Verify the options
    const options = select.findAll('option');
    expect(options.length).toBe(3);
    expect(options[0].element.value).toBe('0');
    expect(options[1].element.value).toBe('L');
    expect(options[2].element.value).toBe('C');
  });

  it('verifies price field exists', () => {
    const wrapper = mount(CalculatePriceRow, {
      props: { row_number: 1 }
    });

    // Find the select element
    const input = wrapper.find('input[type="number"]');
    expect(input.exists()).toBe(true);
  });

  it('calls fetchFees when price is changed', async () => {
    const fetchFeesMock = vi.fn();
    
    const wrapper = mount(CalculatePriceRow, {
      props: { row_number: 1 },
      data() {
        return {
          selectedOption: 'L' // Set selectedOption to 'L'
        };
      },
      methods: {
        fetchFees: fetchFeesMock
      }
    });
    const fetchFeesSpy = vi.spyOn(wrapper.vm, 'fetchFees');

    // Find the input element and set a new value
    const input = wrapper.find('input[type="number"]');
    await input.setValue(100);
    await new Promise(resolve => setTimeout(resolve, 500));
    // Assert that fetchFees was called
    expect(fetchFeesSpy).toHaveBeenCalled();
  });

  it('calls fetchFees when type is changed', async () => {
    const fetchFeesMock = vi.fn();
    
    const wrapper = mount(CalculatePriceRow, {
      props: { row_number: 1 },
      data() {
        return {
          vehiclePrice: 100 
        };
      },
      methods: {
        fetchFees: fetchFeesMock
      }
    });
    const fetchFeesSpy = vi.spyOn(wrapper.vm, 'fetchFees');

    // Find the input element and set a new value
    const input = wrapper.find('select');
    await input.setValue('L');
    await new Promise(resolve => setTimeout(resolve, 500));
    // Assert that fetchFees was called
    expect(fetchFeesSpy).toHaveBeenCalled();
  });

  
})
